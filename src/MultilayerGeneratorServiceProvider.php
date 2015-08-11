<?php

namespace Hamzaouaghad\Multilayering;

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
    ];
    
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
            $loader->alias('MakeDatalayerClass', 'Hamzaouaghad\Multilayering\Console\Commands\Datalayer\MakeDatalayerClass');
            $loader->alias('MakeDatalayerInterface', 'Hamzaouaghad\Multilayering\Console\Commands\Datalayer\MakeDatalayerInterface');
            $loader->alias('MakeDatalayerRepo', 'Hamzaouaghad\Multilayering\Console\Commands\Datalayer\MakeDatalayerRepo');
            $loader->alias('BakeDataLayer', 'Hamzaouaghad\Multilayering\Console\Commands\Datalayer\BakeDataLayer');
            $loader->alias('MakeDataLayer', 'Hamzaouaghad\Multilayering\Console\Commands\Datalayer\MakeDataLayer');


            /*
             |
             | Http layer
             |
             */

            $loader->alias('MakeHttpLayer', 'Hamzaouaghad\Multilayering\Console\Commands\Httplayer\MakeHttpLayer');
            $loader->alias('MakeHttpLayerMotor', 'Hamzaouaghad\Multilayering\Console\Commands\Httplayer\MakeHttpLayerMotor');
            $loader->alias('MakeHttplayerAbstractMotor', 'Hamzaouaghad\Multilayering\Console\Commands\Httplayer\MakeHttplayerAbstractMotor');
            $loader->alias('MakeHttpLayerTrait', 'Hamzaouaghad\Multilayering\Console\Commands\Httplayer\MakeHttpLayerTrait');

            /*
             |
             | General
             |
             */
            $loader->alias('MakeMultilayerSkeleton', 'Hamzaouaghad\Multilayering\Console\Commands\MakeMultilayerSkeleton');
            $loader->alias('BakeAll', 'Hamzaouaghad\Multilayering\Console\Commands\BakeAll');
        });
    }

}