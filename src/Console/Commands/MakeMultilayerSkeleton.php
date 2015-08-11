<?php

namespace Hamzaouaghad\Multilayering\Console\Commands;

use Illuminate\Console\Command;
use File;
use Artisan;

class MakeMultilayerSkeleton extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:multilayer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command generates the directory structure for the multilayering design pattern. More info at https://coderwall.com/p/itnqyq/alternatives-to-hmvc-with-laravel.';

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

        Artisan::call('make:datalayer');
        $this->info(Artisan::output());

        Artisan::call('make:httplayer');
        $this->info(Artisan::output());

        $this->info('=========================================');
        $this->info('Done!');
        $this->info('Build something awesome, Quickly!');
        $this->info('=========================================');
        $this->info('~Hamza Ouaghad @hamza_ouaghad');
    }
}
