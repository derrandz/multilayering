<?php

namespace edenho\multilayergenerator\Console\Commands\Httplayer;

use Illuminate\Console\Command;
use File;
use Illuminate\Filesystem\Filesystem;
use Artisan;

class MakeHttpLayer extends Command
{
    /**
     *Stores a file instance
     *
     *@var Illuminate\Filesystem\Filesystem 
     */
    protected $files;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:httplayer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates the httplayer directory structure';

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
        if(!$this->files->put( app_path().'/Http/Controllers/Controller.php', $this->files->get(__DIR__.'/stubs/Controller.stub')))
        {
            $this->error('Could not update the Controller abstract class');
        }
        else
        {
            $this->info('Abstract Controller class been successfully updated');
        }

        if($this->makeMotorsDirectory())
        {
            Artisan::call('make:httplayer:basemotor', array());
            $this->info(Artisan::output());

            $this->info('app\Http\Motors :');
            $this->info('Motors Directory has been successfully created! ');
        }
        else
        {
            $this->error('WHhhooppss! There was a problem! please verify your permissions');
            return false;
        }

        if($this->makeTraitsDirectory())
        { 
            if(!$this->files->put( app_path().'/Http/Traits/CRUDTrait.php', $this->files->get(__DIR__.'/stubs/CRUDtrait.stub')))
            {
                $this->error('Could not update the Controller abstract class');
            }
            else
            {
                $this->info('Abstract Controller class been successfully updated');
            }
            
            $this->info('app\Http\Traits :');
            $this->info('Motors Directory has been successfully created! ');
        }
        else
        {
            $this->error('WHhhooppss! There was a problem! please verify your permissions');
            return false;
        }

        return true;
    }

    protected function makeMotorsDirectory()
    {
        return $this->makeDirectory('app/Http/Motors');
    }

    protected function makeTraitsDirectory()
    {
        return $this->makeDirectory('app/Http/Traits');
    }

    protected function makeDirectory($path)
    {
        if(!$status = $this->files->makeDirectory($path))
        {
            return $this->files->makeDirectory(dirname($path), 0777, true, true);
        }

        return $status;
    }
}