<?php

namespace drafeef\contacts\providers;

use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider{

    public function register() {

        if($this->app->runningInConsole()){

            $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

            $this->commands([
            ]);
        }


        $this->registerConfig();

    }


    public function boot() {

        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');

        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'contacts');

    }

    protected function registerConfig(){

        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('Api.php'),
        ], 'config');

        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'contacts'
        );

    }
}
