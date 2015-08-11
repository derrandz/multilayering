<?php

namespace Hamzaouaghad\Multilayering\Console\Commands\Datalayer;

use Illuminate\Console\Command;
use File;
use Illuminate\Filesystem\Filesystem;

class MakeDataLayer extends Command
{

    protected $files;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:datalayer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates the datalayer directory structure';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if(!$this->makeDataLayerDirectory())
        {
            $this->error('WHhhooppss! There was a problem! please verify your permissions');
            return false;
        }

        $this->info('app\Datalayer has been successfully created! \n');

        if(!$this->makeContractsDirectory())
        {
            $this->error('WHhhooppss! There was a problem! please verify your permissions');
            return false;
        }

        $this->info('app\Datalayer\Contracts :');
        $this->info('Contracts Directory has been successfully created! ');
        

        if(!$this->makeObjectsDirectory())
        {    
            $this->error('WHhhooppss! There was a problem! please verify your permissions');
            return false;
        }

        $this->info('app\Datalayer\Objects :');
        $this->info('Objects Directory has been successfully created! ');
        
        if(!$this->makeRepositoriesDirectory())
        {
            $this->error('WHhhooppss! There was a problem! please verify your permissions');
            return false;
        }

        $this->info('app\Datalayer\Repositories :');
        $this->info('Repositories Directory has been successfully created! ');

        return true;
    }

    protected function makeDataLayerDirectory()
    {
        return $this->makeDirectory('app/Datalayer');
    }

    protected function makeContractsDirectory()
    {
        return $this->makeDirectory('app/Datalayer/Contracts');
    }

    protected function makeRepositoriesDirectory()
    {
        return $this->makeDirectory('app/Datalayer/Repositories');
    }

    protected function makeObjectsDirectory()
    {
        return $this->makeDirectory('app/Datalayer/Objects');
    }

    protected function makeDirectory($path)
    {
        if (!$this->files->isDirectory($path)) {
            return $this->files->makeDirectory($path, 0777, true, true);
        }

        return false;
    }
}