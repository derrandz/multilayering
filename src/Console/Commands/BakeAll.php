<?php

namespace Hamzaouaghad\Multilayering\Console\Commands;

use Illuminate\Console\Command;
use Artisan;

class BakeAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bake:all {name} {--motor=} {--repository=} {--interface=} {--trait=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates an eloquent class, an interface and a repository for it, also a motor, and a trait if specified.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {   
        $class      = $this->getNameInput();
        $repository = $this->getRepositoryInput();
        $interface  = $this->getInterfaceInput();
        $trait      = $this->getTraitInput();
        $motor      = $this->getMotorInput();

        if(is_null($motor))
        {
            $motor = $class;
        }

        $this->info($this->callBakeDatalayer($class, $repository, $interface));
        $this->info($this->callMakeMotor($motor, $trait, $repository));

        $this->info('');
        $this->info('=========================================');
        $this->info('All baked rigth! Proceed!');
        $this->info('=========================================');
        $this->info('');    
        return true;
    }

    protected function callMakeMotor($motor, $trait, $repository)
    {
        Artisan::call('make:httplayer:motor', ['name' => $motor, '--trait' => $trait, '--repository' => $repository]);
        return Artisan::output();
    }

    protected function callBakeDatalayer($class, $repository, $interface)
    {
        Artisan::call('bake:datalayer', ['class' => $class, '--repository' => $repository, '--interface'  => $interface]);

        return Artisan::output();
    }

    protected function getNameInput()
    {
        return $this->argument('name');
    }

    protected function getMotorInput()
    {
        return $this->option('motor');
    }


    protected function getInterfaceInput()
    {
        return $this->option('interface');
    }


    protected function getRepositoryInput()
    {
        return $this->option('repository');
    }


    protected function getTraitInput()
    {
        return $this->option('trait');
    }


}