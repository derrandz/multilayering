<?php

namespace Hamzaouaghad\Multilayering\Console\Commands\Datalayer;

use Illuminate\Console\Command;
use Artisan;

class BakeDataLayer extends Command
{

    protected $className;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bake:datalayer {class} {--repository=} {--interface=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bake the data layer for the given class';

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
        $isRepositoryPresent = false;
        $isInterfacePresent  = false;

        $class = $this->getClassArgument();

        if(is_null( $interface = $this->getInterfaceInput() ))
        {
            $interface = $class;
        }
        else
        {
            $interface = $interface;
        }

        if(is_null( $repository = $this->getRepositoryInput() ))
        {
            $repository = $class;
        }
        else
        {
            $repository = $repository;
        }

        Artisan::call('make:datalayer:class', ['name' => $class]);
        $classOutput = Artisan::output();

        Artisan::call('make:datalayer:interface', ['name' => $interface]);
        $interfaceOutput = Artisan::output();

        Artisan::call('make:datalayer:repository',[ 
                                                    'name'          => $repository, 
                                                    '--interface'   => $interface, 
                                                    '--class'       => $class
                                                    ]);
        $repositoryOutput = Artisan::output();

        $this->info($classOutput.$interfaceOutput.$repositoryOutput);
    }

    /*
     |
     | Input Handling
     |
     */
    protected function getClassArgument()
    {
        return $this->argument('class');
    }

    protected function getInterfaceInput()
    {
        return $this->option('interface');
    }

    protected function getRepositoryInput()
    {
        return $this->option('repository');
    }

}