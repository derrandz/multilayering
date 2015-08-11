<?php

namespace Edenho\Multilayergenerator;

use Illuminate\Support\ServiceProvider;

class MultilayerGeneratorServiceProvider extends ServiceProvider
{

    /**
     * Artisan commands for multilayering
     *
     *@var array
     */

    protected $commands = [
        MakeDatalayerClass::class,
        MakeDatalayerInterface::class,
        MakeDatalayerRepo::class,
        MakeMultilayerSkeleton::class,
        MakeHttpLayer::class,
        MakeDataLayer::class,
        BakeDataLayer::class,
        MakeHttplayerAbstractMotor::class,
        MakeHttpLayerMotor::class,
        BakeAll::class,
    ]
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->commands);
        
        $this->publishes([
                __DIR__.'/providers/MultilayerGeneratorServiceProvider.php' => app_path('Providers/MultilayerGeneratorServiceProvider.php'),
        ]);
        
        $this->app->booting(function()
        {

            /*
             |
             | Data layer
             |
             */
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('MakeDatalayerClass', 'Edenho\Multilayergenerator\Console\Commands\Datalayer\MakeDatalayerClass');
            $loader->alias('MakeDatalayerInterface', 'Edenho\Multilayergenerator\Console\Commands\Datalayer\MakeDatalayerInterface');
            $loader->alias('MakeDatalayerRepo', 'Edenho\Multilayergenerator\Console\Commands\Datalayer\MakeDatalayerRepo');
            $loader->alias('BakeDataLayer', 'Edenho\Multilayergenerator\Console\Commands\Datalayer\BakeDataLayer');
            $loader->alias('MakeDataLayer', 'Edenho\Multilayergenerator\Console\Commands\Datalayer\MakeDataLayer');


            /*
             |
             | Http layer
             |
             */

            $loader->alias('MakeHttpLayer', 'Edenho\Multilayergenerator\Console\Commands\Httplayer\MakeHttpLayer');
            $loader->alias('MakeHttpLayerMotor', 'Edenho\Multilayergenerator\Console\Commands\Httplayer\MakeHttpLayerMotor');
            $loader->alias('MakeHttplayerAbstractMotor', 'Edenho\Multilayergenerator\Console\Commands\Httplayer\MakeHttplayerAbstractMotor');
            $loader->alias('MakeHttpLayerTrait', 'Edenho\Multilayergenerator\Console\Commands\Httplayer\MakeHttpLayerTrait');

            /*
             |
             | General
             |
             */
            $loader->alias('MakeMultilayerSkeleton', 'Edenho\Multilayergenerator\Console\Commands\MakeMultilayerSkeleton');
            $loader->alias('BakeAll', 'Edenho\Multilayergenerator\Console\Commands\BakeAll');
        });
    }

}