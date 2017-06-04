<?php

namespace Vector88\GaeFs\Filesystem;

use League\Flysystem\Adapter\Local;
use League\Flysystem\Config;

/**
 * Class GaeFsAdapter
 * @package Vector88\GaeFs\Filesystem
 */
class GaeFsAdapter extends Local {

    /**
     * {@inheritdoc}
     */
    public function __construct( $root ) {
        parent::__construct( $root, 0, self::DISALLOW_LINKS );
    }

    /**
     * {@inheritdoc}
     */
    protected function ensureDirectory( $root ) {
        if( is_dir( $root ) === false ) {
            mkdir( $root, 0755, true );
        }
        return gae_realpath( $root );
    }

    /**
     * {@inheritdoc}
     */
    public function writeStream( $path, $resource, Config $config ) {
        $location = $this->applyPathPrefix( $path );
        $this->ensureDirectory( dirname( $location ) );

        if ( !( $stream = fopen( $location, 'w' ) ) ) {
            return false;
        }

        while( !feof( $resource ) ) {
            fwrite( $stream, fread( $resource, 1024 ), 1024 );
        }

        if ( !fclose( $stream ) ) {
            return false;
        }

        if( $visibility = $config->get( 'visibility' ) ) {
            $this->setVisibility( $path, $visibility );
        }

        return compact( 'path', 'visibility' );
    }

    /**
     * @inheritdoc
     */
    public function applyPathPrefix( $path ) {
        $prefixedPath = parent::applyPathPrefix( $path );
        return rtrim( $prefixedPath, DIRECTORY_SEPARATOR );
    }

}
