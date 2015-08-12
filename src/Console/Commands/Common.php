<?php

namespace Hamzaouaghad\Multilayering\Console\Commands;

trait Common
{

	protected function getServiceProvider()
	{
		return $this->files->get( $this->getServiceProviderPath() );
	}

	protected function getServiceProviderPath()
	{
		return app_path().'/Providers/MultilayerGeneratorServiceProvider.php';
	}

	protected function replaceAliasLoader($file, $replaced, $replacer)
	{
		return str_replace($replaced, $replacer, $file);
	}
	protected function updateProvider($replaced, $replacer)
	{
		$serviceProvider = $this->getServiceProviderPath();

		$content = $this->replaceAliasLoader($this->getServiceProvider(), $replaced, $replacer);

		$this->files->put($serviceProvider, $content);

		$this->info('');
		$this->info('');
        $this->info('MultilayeringServiceProvider updated with:');

		$this->info('');
		$this->info('');
		$this->info('========================================================');
        $this->info($replacer);
		$this->info('');
		$this->info('========================================================');
		$this->info('');
        $this->info('Do not forget to run `php artisan vendor:publish`');
        $this->info('Bye!');
	}

	protected function shortenName($name)
    {
        $name = str_replace($this->getNamespace($name).'\\', '', $name);
        return $name;
    }
}