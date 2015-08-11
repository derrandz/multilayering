<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// use MakeDatalayerClass;
// use MakeDatalayerInterface;
// use MakeDatalayerRepo;
// use MakeMultilayerSkeleton;
// use MakeHttpLayer;
// use MakeDataLayer;
// use BakeDataLayer;
// use MakeHttplayerAbstractMotor;
// use MakeHttpLayerMotor;
// use BakeAll;


class MultilayerGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Artisan commands for the kernel.php
     *
     *@var array
     */
    // protected $commands = [
    //     MakeDatalayerClass::class,
    //     MakeDatalayerInterface::class,
    //     MakeDatalayerRepo::class,
    //     MakeMultilayerSkeleton::class,
    //     MakeHttpLayer::class,
    //     MakeDataLayer::class,
    //     BakeDataLayer::class,
    //     MakeHttplayerAbstractMotor::class,
    //     MakeHttpLayerMotor::class,
    //     BakeAll::class,
    // ];
    
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
        $this->commands($this->commands);
    }
}
