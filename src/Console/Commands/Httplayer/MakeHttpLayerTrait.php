<?php

namespace Hamzaouaghad\Multilayering\Console\Commands\Httplayer;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

use Hamzaouaghad\Multilayering\Console\Commands\Common as Common;

class MakeHttpLayerTrait extends GeneratorCommand
{

    use Common;
    
    protected $type = 'Trait';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:httplayer:trait {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a trait.';
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
        $name = $this->parseName($this->getNameInput());
        $name = $this->editName($name);

        $aliasLoader = "\t\t\t\t$" . "loader->alias('" .$this->shortenName($name). "', '" . "$name" . "');";
        $aliasLoader = "//DummyAliasLoadingForTraits\n".$aliasLoader;

        if ($this->files->exists($path = $this->getPath($name))) {
            $this->error($this->type.' already exists!');

            return false;
        }

        $this->makeDirectory($path);

        $this->files->put($path, $this->buildClass($name));

        $this->info($this->type.' created successfully.'.$name.'.php');

        $this->updateProvider('//DummyAliasLoadingForTraits', $aliasLoader);
    }

    protected function editName($name)
    {
        return str_replace("App", "App\Http\Traits", $name.'Trait');
    }

    protected function buildClass($name)
    {
        $stub              = $this->files->get($this->getStub());
        $interface         = $this->parseName($this->getInput());

        return $this->replaceNamespace($stub, $name)->replaceTrait($stub,  $name);
    }

    protected function parseName($name)
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

    protected function replaceTrait($stub, $name)
    {
        $class = str_replace($this->getNamespace($name).'\\', '', $name);

        return str_replace('DummyTrait', $class, $stub);
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/Trait.stub';
    }

    protected function getInput()
    {
        return $this->argument('name');
    }
}