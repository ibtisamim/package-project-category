<?php

namespace drafeef\base\providers;

use drafeef\base\Console\Commands\Setup;
use Illuminate\Support\ServiceProvider;
use drafeef\base\Console\Commands\DefaultLanguage;

class AppServiceProvider extends ServiceProvider{

    public function register() {

        if($this->app->runningInConsole()){

            $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

            $this->commands([Setup::class,DefaultLanguage::class]);
        }

        $this->registerConfig();

    }


    public function boot() {

        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'base');

    }

    protected function registerConfig(){

        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('Api.php'),
        ], 'config');

        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'base'
        );

    }
}
