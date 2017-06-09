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

Next you can use it like this:

```php
$versio = new LaravelVersio;
```

`$versio` will now have the following modules available:

```php
->domains()
    ->get($domain) // domain info
    ->getDnsRecords($domain) // domain dns records
    ->register($domain, (int) $contactId, (int) $years, array $nameservers) // register domain
    ->renew($domain, (int) $years) // renew a domain
    ->update($domain, $data) // update a domain
    ->available($domain) // check if a domain is available
    ->setDnsManagement($domain) // set domain on DNS management
    ->setNameServerManagement($domain) // set domain on nameserver management
->contacts()
    ->get((int) $contactId) // get a contact
    ->create(array $data) // create a contact
->tlds()
    ->prices() // overview for prices
    ->info($tld) // tld info
```

You will have to get the API documentation from VERSIO to see what you can fill in the arrays:
https://www.versio.nl/RESTapidoc/

## License

The laravel versio package is open source software licensed under the [license MIT](http://opensource.org/licenses/MIT)