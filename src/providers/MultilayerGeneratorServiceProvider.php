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
         |
         |  Add your newly created repositories as follows
         |
         */

            // $loader->alias('MyClassRepository', 'App\DataLayer\Repositories\MyClassRepository');
            // $loader->alias('MyClassRepoInterface', 'MyClassRepository');
            
        /*
         |
         | Object Classes
         |
         |
         | Add your newly created object classes as follows
         |
         */
         
            // $loader->alias('MyClass', 'App\DataLayer\Objects\MyClass');

        /*
         |
         | Traits 
         |  
         | If you have generated any traits, add them as follows.
         | if you have generated the whole directory structure with `make:multilayer`
         | Uncomment the 'crudtrait' trait and vendor:publish
         |
         */
            // $loader->alias('CRUDtrait', 'App\Http\Traits\CRUDtrait');

        /*
         |
         | Motors
         |  
         |
         | Add your newly created motor
         */

            // $loader->alias('Motor', 'App\Http\Motors\Motor');
            // $loader->alias('MyNewMotor', 'App\Http\Controllers\Motors\MyNewMotor');
        });

    }
}
