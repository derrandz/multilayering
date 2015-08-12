<?php

namespace Hamzaouaghad\Multilayering;

use Illuminate\Support\ServiceProvider;

use MakeDatalayerClass;
use MakeDatalayerInterface;
use MakeDatalayerRepo;
use MakeMultilayerSkeleton;
use MakeHttpLayer;
use MakeDataLayer;
use BakeDataLayer;
use MakeHttplayerAbstractMotor;
use MakeHttpLayerMotor;
use MakeHttpLayerTrait;
use BakeAll;

class RegisterCommandsServiceProvider extends ServiceProvider
{
    /**
     * Artisan commands for the kernel.php
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
        MakeHttpLayerTrait::class,
        BakeAll::class,
    ];
    
    /**
     * Artisan commands for multilayering
     *
     *@var array
     */

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
    }

}