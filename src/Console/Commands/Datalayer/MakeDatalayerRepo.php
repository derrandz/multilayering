<?php

namespace edenho\multilayergenerator\Console\Commands\Datalayer;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class MakeDatalayerRepo extends GeneratorCommand
{
    protected $type    = 'Repository';

    private $dirPath = 'edenho\multilayergenerator';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:datalayer:repository {name : The name of the repository} 
                                                      {--interface= : The implemented interface/contract}
                                                      {--class= : The class to be using}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command generates an repository. If no path is specified with the name, this command will put the file in the default datalayer\objects directory.';

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
        $name      = $this->parseName($this->getNameInput());
        $name = $this->editName($name);

        if ($this->files->exists($path = $this->getPath($name))) {
            $this->error($this->type.' already exists!');

            return false;
        }

        $this->makeDirectory($path);

        $this->files->put($path, $this->buildClass($name));

        $this->info($this->type.' created successfully. '.$name.'.php');
    }

    protected function editName($name)
    {
        return str_replace("App", "App\Datalayer\Repositories", $name);
    }


    protected function buildClass($name)
    {
        $stub              = $this->files->get($this->getStub());
        $interface         = $this->parseInterface($this->getInterfaceInput());
        $class             = $this->parseClass($this->getClassInput());

        $replacedNamespace = $this->replaceNamespace($stub, $name);

        return $replacedNamespace->replaceRepo(
            
            $replacedNamespace->setClass(
                    $replacedNamespace->setInterface(
                        $stub,  
                        $interface
                                                    ),
                    $class), 
            $name
                                                );
    }



    protected function replaceRepo($stub, $name)
    {
        $class     = str_replace($this->getNamespace($name).'\\', '', $name);

        return str_replace('DummyRepo', $class, $stub);
    }

    protected function setInterface($stub, $interface)
    {
        $interface = str_replace($this->getNamespace($interface).'\\', '', $interface);

        return str_replace('DummyInterface', $interface, $stub);
    }

    protected function setClass($stub, $class)
    {
        $class = str_replace($this->getNamespace($class).'\\', '', $class);

        return str_replace('DummyClass', $class, $stub);
    }


    protected function getStub()
    {
        return __DIR__.'/stubs/Repository.stub';
    }



    protected function parseInterface($name)
    {
        $rootNamespace = $this->laravel->getNamespace();

        if (Str::startsWith($name, $rootNamespace)) {
            return $name;
        }

        if (Str::contains($name, '/')) {
            $name = str_replace('/', '\\', $name);
        }

        return $this->parseName($this->getDefaultNamespace(trim($rootNamespace, '\\')).'\\'.$name);
    }

    protected function parseClass($name)
    {
        $rootNamespace = $this->laravel->getNamespace();

        if (Str::startsWith($name, $rootNamespace)) {
            return $name;
        }

        if (Str::contains($name, '/')) {
            $name = str_replace('/', '\\', $name);
        }

        return $this->parseName($this->getDefaultNamespace(trim($rootNamespace, '\\')).'\\'.$name);
    }



    protected function getInterfaceInput()
    {
        return $this->option('interface');
    }

    protected function getClassInput()
    {
        return $this->option('class');
    }
}