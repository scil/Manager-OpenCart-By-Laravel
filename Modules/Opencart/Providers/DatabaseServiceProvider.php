<?php

namespace Modules\Opencart\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
        $connections = config('database.connections');
        if (strpos(DB_DRIVER, 'pgsql') !== false) {
            $default = 'opencart_pgsql';
            $connections[$default] = [
                'driver' => 'pgsql',
                'url' => env('DATABASE_URL'),
                'host' => env('DB_HOST', DB_HOSTNAME),
                'port' => env('DB_PORT', DB_PORT),
                'database' => env('DB_DATABASE', DB_DATABASE),
                'username' => env('DB_USERNAME', DB_USERNAME),
                'password' => env('DB_PASSWORD', DB_PASSWORD),
                'charset' => 'utf8',
                'prefix' => '',
                'prefix_indexes' => true,
                'schema' => 'public',
                'sslmode' => 'prefer',
            ];
        } else {
            $default = 'opencart_mysql';
            $connections[$default] = [
                'driver' => 'mysql',
                'url' => env('DATABASE_URL'),
                'host' => env('DB_HOST', DB_HOSTNAME),
                'port' => env('DB_PORT', DB_PORT),
                'database' => env('DB_DATABASE', DB_DATABASE),
                'username' => env('DB_USERNAME', DB_USERNAME),
                'password' => env('DB_PASSWORD', DB_PASSWORD),
                'unix_socket' => env('DB_SOCKET', ''),
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'prefix' => '',
                'prefix_indexes' => true,
                'strict' => true,
                'engine' => null,
                'options' => extension_loaded('pdo_mysql') ? array_filter([
                    \PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
                ]) : [],
            ];
        }

        config([
            'database.connections' => $connections,
            'database.default' => $default,
        ]);
        Log::info("config('database.default') is set to [$default] with OpenCart DB_DRIVER ["
            . DB_DRIVER
            . ']');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
