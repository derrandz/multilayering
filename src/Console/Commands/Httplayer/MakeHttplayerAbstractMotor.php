<?php

namespace Hamzaouaghad\Multilayering\Console\Commands\Httplayer;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;

class MakeHttplayerAbstractMotor extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:httplayer:basemotor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates an abstract motor class for inheritence.';
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct($files);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        return $this->fire();
    }

    public function fire()
    {
        if ($this->files->exists($path = $this->getPath('App\Http\Motors\Motor'))) {
            $this->error('Abstract motor class already exists!');

            return false;
        }

        $this->makeDirectory($path);

        $this->files->put($path, $this->buildClass('App\Http\Motors\Motor'));

        $this->info('Motor abstract class has been created successfully.');
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/MotorAbstract.stub';
    }
}