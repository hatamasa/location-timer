<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class ConfigServiceProvider extends ServiceProvider
{
    public function register()
    {
        $env = App::environment();
        $env_config = Config::get($env);
        if($env_config && is_array($env_config)) {
            Config::set(array_replace_recursive(Config::all(), $env_config));
        }
    }
}