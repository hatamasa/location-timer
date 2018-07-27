<?php

namespace App\Providers;

use Illuminate\Database\Connection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class EnvConfigServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Connection::class, function ($app) {
            return new Connection(config('envConfig'));
        });
    }

    public function boot()
    {
        $env = App::environment();
        $env_config = Config::get($env);
        if($env_config && is_array($env_config)) {
            Config::set(array_replace_recursive(Config::all(), $env_config));
        }
    }
}