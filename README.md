# Multilayering

[![Software License][ico-license]](LICENSE.md)

This package is a tiny laravel package that generates artisan commands to generate the multilayer conventions faster, and speed up the workflow.

If you don't know what multilayer is , feel free to have quick read at [coderwall](https://coderwall.com/p/itnqyq/alternatives-to-hmvc-with-laravel)
## Install

Via Composer

``` bash
$ composer require hamzaouaghad/multilayering
```

## Usage

Make sure you add this line in your `Config\app.php`
``` php
 'providers' => [

 Hamzaouaghad\Multilayering\MultilayerGeneratorServiceProvider::class,
 Hamzaouaghad\Multilayering\RegisterCommandsServiceProvider::class,

 ],
```

save and run

```bash
 $ php artisan vendor:publish
 ```
 Now to go your 'app/providers/', you will find two new providers add :

`MultilayerGeneratorServiceProvider`

 If it's your first time, and you still need to generate the new folder structure, please run:
 
 ```bash
 php artisan make:multilayer
 ```
 
 And afterwards, go to your service providers, and uncomment the abstract motor class as well as the crudtrait in `MultilayeringGeneratorServiceProvider`.


 If you wish to quicken the paste, and bake all, you may use the following command :
 ```bash
 php artisan bake:all ClassName
 ```
 This command will generate an eloquent class, an interface for it, and a repository that uses this interface. Also, at the http layer, it generates a motor for it that injects that repository.

 If you may to bake all with specifics, you may use the following options:
```bash
--interface : The name of the interface to be created for our calss
--motor : the name of the motor to be created for our class
--trait : the name of the trait that your motor maye use
--repository : the name of the repository that this class would be covered under.
```

Don't forget to go your service providers, in your `MultilayeringGeneratorServiceProvider`,add everything you created appropriately as described in the comments,


--Example :
```bash
php artisan bake:all User --repository=Accounts --interface=Security --motor=STAFF --trait=Authentication
```

This will create :

```php
class User extends Eloquent
```
and
```php
interface SecurityInterface
```
and

```php
class AccountsRepository implements SecurityInterface
```

and

```php
class STAFFmotor extends Motor
{
 public function __construct(AccountsRepository $repo)
 {
    $this->repository = $repo;
 }

 use /Authentication;
}
```

After all of this, you will have to add the new classes and interfaces to the `Providers\MultilayerGeneratorServiceProvider` as aliases this way :

```php

class MultilayerGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->booting(function(){
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        /*
         |
         | Repositories Classes
         |
         */

             $loader->alias('AccountsRepository', 'App\DataLayer\Repositories\AccountsRepository');
             $loader->alias('AccountsRepoInterface', 'AccountsRepository');
            
        /*
         |
         | Object Classes
         |
         */
         
             $loader->alias('User', 'App\DataLayer\Objects\User');

        /*
         |
         | Traits 
         |  
         */
            $loader->alias('CRUDtrait', 'App\Http\Traits\CRUDtrait');//don't modify this.
            $loader->alias('AuthenticationTrait', 'App\Http\Traits\Authentication');

        /*
         |
         | Motors
         |  
         */

            $loader->alias('Motor', 'App\Http\Motors\Motor');
            $loader->alias('STAFFmotor', 'App\Http\Controllers\Motors\STAFFmotor');
        });
    }
}

```

If you wish to avoid all of this, just make use of the `use` statements, like this:

`use App\Http\Motors\STAFFmotor as STAFFmotor` 

for instance.

######Note that the multilayer conventions stands heavily on the shortnamed classes, so adding these aliases is of higher importance.
 Available commands
```bash

 bake
  bake:all                   Creates an eloquent class, an interface and a repository for it, also a motor, and a trait if specified.
  bake:datalayer             Bake the data layer for the given class
 make
  make:controller            Create a new resource controller class
  make:datalayer             Creates the datalayer directory structure
  make:datalayer:class       Creates an eloquent class, its interface and its repository.
  make:datalayer:interface   Creates an interface.
  make:datalayer:repository  Creates a repository
  make:httplayer             Creates the httplayer directory structure
  make:httplayer:basemotor   Creates an abstract motor class for inheritence.
  make:httplayer:motor       Creates a motor, with the injected specified repository, and the trait to be used.
  make:httplayer:trait
  make:multilayer            This command generates the directory structure for the multilayering conventions.
  
```


If you wish to go your own way, without mass baking, you can use the following

```bash
php artisan make:datalayer:class <name>

php artisan make:datalayer:interface <name>

php artisan make:datalayer:repository <name> (with options: --interface= the one you wish your repo to implement, --class=The class whose repo is this
```
## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email ouaghad.hamza@gmail.com instead of using the issue tracker.

## Credits

- [Hamza Ouaghad](https://twitter.com/hamza_ouaghad)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/league/:package_name.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/thephpleague/:package_name/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/thephpleague/:package_name.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/thephpleague/:package_name.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/league/:package_name.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/league/:package_name
[link-travis]: https://travis-ci.org/thephpleague/:package_name
[link-scrutinizer]: https://scrutinizer-ci.com/g/thephpleague/:package_name/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/thephpleague/:package_name
[link-downloads]: https://packagist.org/packages/league/:package_name
[link-author]: https://github.com/:author_username
[link-contributors]: ../../contributors
