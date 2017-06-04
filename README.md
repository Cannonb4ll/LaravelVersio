# Laravel Versio

Laravel 5 package for communicating with the API from versio.nl

## Installation 

You can install the package through Composer.
```bash
composer require laravel-versio/laravel-versio
```
You must install this service provider.
```php
// config/app.php
'providers' => [
    LaravelVersio\ServiceProvider::class,
];
```

Then publish the config and migration file of the package using artisan.
```bash
php artisan vendor:publish --provider="LaravelVersio\ServiceProvider"
```
And adjust config file (`config/versio.php`) with your desired settings.

## Usage

All that is left to do is to define 3 ENV configuration variables.

```
VERSIO_EMAIL=
VERSIO_PASSWORD=
VERSIO_TEST=
```

## License

The laravel versio package is open source software licensed under the [license MIT](http://opensource.org/licenses/MIT)