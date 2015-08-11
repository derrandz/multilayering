<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MultilayerGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->booting(function(){
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        /*
         |
         | Repositories Classes
         |
         */

            // $loader->alias('MyClassRepository', 'App\DataLayer\Repositories\MyClassRepository');
            // $loader->alias('MyClassRepoInterface', 'MyClassRepository');
            
        /*
         |
         | Object Classes
         |
         */
         
            // $loader->alias('MyClass', 'App\DataLayer\Objects\MyClass');

        /*
         |
         | Traits 
         |  
         */
            $loader->alias('CRUDtrait', 'App\Http\Traits\CRUDtrait');

        /*
         |
         | Motors
         |  
         */

            $loader->alias('Motor', 'App\Http\Motors\Motor');
            // $loader->alias('MyNewMotor', 'App\Http\Controllers\Motors\MyNewMotor');
        });
    }
}
