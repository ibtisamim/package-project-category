<?php

namespace drafeef\base\providers;

use drafeef\users\Http\Middlewares\ApiTokenMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = "drafeef\base\Http\Controllers";

    protected string $version = "v1";

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot(){

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map(){

        $this->mapApiRoutes();
    }


    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes(){

        Route::prefix('api/common/' . $this->version)
            ->namespace($this->namespace)
            ->middleware(ApiTokenMiddleware::class)
            ->group(__DIR__.'/../routes/api.php');

    }


}
