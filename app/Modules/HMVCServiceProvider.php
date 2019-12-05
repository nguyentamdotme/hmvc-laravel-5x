<?php

namespace App\Modules;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class HMVCServiceProvider extends ServiceProvider
{
    private $configFile = [
        'sample' => 'Sample/config/sample.php',
    ];

    public function boot()
    {
        $directories = array_map('basename', File::directories(__DIR__));
        foreach ($directories as $moduleName) {
            $this->_registerModule($moduleName);
        }
    }

    public function register()
    {
        foreach ($this->configFile as $alias => $path) {
            $this->mergeConfigFrom(__DIR__ . "/" . $path, $alias);
        }
    }

    private function _registerModule($moduleName) {
        $modulePath = __DIR__ . "/$moduleName/";
        // boot route web
        if (File::exists($modulePath . "/routes/web.php")) {
            $this->loadRoutesFrom($modulePath . "/routes/web.php");
        }

        if (File::exists($modulePath . "/routes/api.php")) {
            $this->loadRoutesFrom($modulePath . "/routes/api.php");
        }
        
        // boot migration
        if (File::exists($modulePath . "Migrations")) {
            $this->loadMigrationsFrom($modulePath . "Migrations");
        }
        // // boot languages
        // if (File::exists($modulePath . "Languages")) {
        //     $this->loadTranslationsFrom($modulePath . "Languages", $moduleName);
        // }
        // boot views
        if (File::exists($modulePath . "Views")) {
            $this->loadViewsFrom($modulePath . "Views", $moduleName);
        }
    }
}
