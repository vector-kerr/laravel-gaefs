<?php

namespace Vector88\GaeFs;

use Illuminate\Support\ServiceProvider;
use Vector88\GaeFs\Filesystem\GaeFsAdapter;

class GaeFsServiceProvider extends ServiceProvider {

    /**
     * Bootstrap application services.
     * @return void
     */
    public function boot() {
        Storage::extend( 'gae', function( $app, $config ) {
            return new Flysystem( new GaeFsAdapter( $config[ 'root' ] ) );
        } );
    }

    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
        //
    }
    
}
