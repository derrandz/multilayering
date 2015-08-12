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
        /*
         |
         |---------------------------------------------------------------------------------
         | Please do not uncomment the commented lines, do not delete them, nor edit them.
         | any action will result in serious damage to the package functionality.
         |--------------------------------------------------------------------------------
         |
         */


        $this->app->booting(function(){
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        /*
         |
         | Interfaces
         |
         */
            //DummyAliasLoadingForInterfaces

        /*
         |
         | Repositories Classes
         |
         */
            //DummyAliasLoadingForRepositories
            
        /*
         |
         | Object Classes
         |
         */
         
            //DummyAliasLoadingForObjects

        /*
         |
         | Traits 
         |  
         */
            $loader->alias('CRUDtrait', 'App\Http\Traits\CRUDtrait');
            //DummyAliasLoadingForTraits

        /*
         |
         | Motors
         |  
         */

            $loader->alias('Motor', 'App\Http\Motors\Motor');
            //DummyAliasLoadingForMotors
        });

    }
}
