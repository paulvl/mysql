<?php

namespace PaulVL\Mysql;

use Illuminate\Support\ServiceProvider;

class BackupServiceProvider extends ServiceProvider
{
    /**
    * Bootstrap the application services.
    *
    * @return void
    */
    public function boot()
    {
    //Publishes package config file to applications config folder
    $this->publishes([__DIR__.'/config/backup.php' => config_path('backup.php')]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerDumpCommand();
        $this->registerRestoreCommand();
    }

     /**
    * Register the mysql:dump command.
    */
    private function registerDumpCommand()
    {

        $this->app->singleton('command.paulvl-mysql.dump', function ($app) {
        return $app['PaulVL\Mysql\Console\Commands\Dump'];
        });
        $this->commands('command.paulvl-mysql.dump');
    }

     /**
    * Register the mysql:restore command.
    */
    private function registerRestoreCommand()
    {

        $this->app->singleton('command.paulvl-mysql.restore', function ($app) {
        return $app['PaulVL\Mysql\Console\Commands\Restore'];
        });
        $this->commands('command.paulvl-mysql.restore');
    }
}
