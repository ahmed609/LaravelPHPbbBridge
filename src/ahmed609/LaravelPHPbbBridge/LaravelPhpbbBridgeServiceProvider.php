<?php

namespace ahmed609\LaravelPHPbbBridge;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;


class LaravelPhpbbBridgeServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/laravel-phpbb-bridge.php' => config_path('laravel-phpbb-bridge.php'),
        ], 'config');

        Route::group(['middleware' => ['web']], function () {
            Route::get('/auth-bridge/login', 'ahmed609\LaravelPhpbbBridge\Controllers\ApiController@getSession');
            Route::post('/auth-bridge/login', 'ahmed609\LaravelPhpbbBridge\Controllers\ApiController@doLogin');
            Route::delete('/auth-bridge/login', 'ahmed609\LaravelPhpbbBridge\Controllers\ApiController@doLogout');
        });
    }

    public function register()
    {
        //
    }
}

