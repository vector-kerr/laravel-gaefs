# laravel-gaefs

Google App Engine (GAE) Filesystem Support for Laravel 5.4.

This package is made from GAE filesystem code included in
[Ron Shpasser's Laravel 5 GAE Support Library](https://github.com/shpasser/GaeSupportL5)
(Released under the [MIT License](https://github.com/shpasser/GaeSupportL5/blob/master/LICENSE)).



# Installation

1. Require the `laravel-gaefs` package in your Laravel project.

    `composer require vector88/laravel-gaefs`

1. Add the `GaeFsServiceProvider` to the `providers` array in `config/app.php`:

    ```php
    'providers' => [
        ...
        Vector88\GaeFs\GaeFsServiceProvider::class,
        ...
    ],
    ```

1. Add a `'gae'` disk to `config/filesystem.php`:

    ```php
    'disks' => [
        ...
        'gae' => [
            'driver' => 'gae',
            'root' => env( 'GAE_FILESYSTEM_ROOT', storage_path() . '/app.php' ),
        ],
        ...
    ],
    ```

1. Update your environment variables to use the GAE filesystem:

    ```bash
    FILESYSTEM = gae
    ```

# Author

Daniel 'Vector' Kerr <vector.kerr@gmail.com>
