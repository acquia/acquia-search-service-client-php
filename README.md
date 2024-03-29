# Acquia Search Service PHP Client

[![Build Status](https://travis-ci.org/acquia/acquia-search-service-client-php.png)](https://travis-ci.org/acquia/acquia-search-service-client-php)
[![Coverage Status](https://coveralls.io/repos/acquia/acquia-search-service-client-php/badge.png?branch=master)](https://coveralls.io/r/acquia/acquia-search-service-client-php?branch=master)
[![Total Downloads](https://poser.pugx.org/acquia/acquia-search-service-client-php/downloads.png)](https://packagist.org/packages/acquia/acquia-search-service-client-php)
[![Latest Stable Version](https://poser.pugx.org/acquia/acquia-search-service-client-php/v/stable.png)](https://packagist.org/packages/acquia/acquia-search-service-client-php)

This repository contains a PHP client library for Acquia Search as well as a command line tool
that can be run via any *nix-like terminal.

Acquia Search is an Acquia Service that provides Search as a Service. More information can be found here:
https://www.acquia.com/products-services/acquia-network/cloud-services/acquia-search

Its API can be used to get valuable information about your search index and also allows to configure and modify files
such as synonyms, stopwords, protected words and suggestions.

## Installation

### Phar (Recommended for CLI use)

Visit https://github.com/acquia/acquia-search-service-client-php/releases/latest and download the
latest stable version. The usage examples below assume this method of installation.

### Composer (Recommended for development and integration with software)

Acquia Search Service PHP Client can be installed with [Composer](http://getcomposer.org)
by adding it as a dependency to your project's composer.json file.

```json
{
    "require": {
        "acquia/acquia-search-service-client-php": "*"
    }
}
```

Please refer to [Composer's documentation](https://github.com/composer/composer/blob/master/doc/00-intro.md#introduction)
for more detailed installation and usage instructions.

## Usage

### CLI Tool

Execute `php acquia-search-service.phar list` to see all available commands.

When you run the first command that consumes an API resource, you will be
prompted for your public and private API keys. If the credentials are invalid,
you can remove them by running `php acquia-search-service.phar identity:remove` and try again.

**Examples

    php acquia-search-service.phar index

    php acquia-search-service.phar ping

    php acquia-search-service.phar stopwords:delete
    
    php acquia-search-service.phar stopwords:create "a" "the" "an" "your" "you"

    php acquia-search-service.phar stopwords

    php acquia-search-service.phar protwords:delete

    php acquia-search-service.phar protwords:create "thisshouldbeanunstemmedword" "andanother"

    php acquia-search-service.phar protwords

    php acquia-search-service.phar synonyms:delete

    php acquia-search-service.phar synonyms:create "GB;Gigabyte;GiB" "Saint;St.;St" "New York;NYC"

    php acquia-search-service.phar synonyms

    php acquia-search-service.phar suggestions:delete

    php acquia-search-service.phar suggestions:create "Suitcases;1.2" "Luxurious Suitcases;2.3" "Travel bag"

    php acquia-search-service.phar suggestions

*NOTE*: If you installed this library with Composer, replace `php acquia-search-service.phar` with
`vendor/bin/acquia-search-service`.

### PHP Library

Make sure to source the autoloader generated by Composer so the classes are
made available.

```php
require_once 'vendor/autoload.php';
```

Instantiate the client using the following information

**Search Identifier.

This is the Search Index identifier that you want to interact with. This could be the same as your network identifier.
See your Drupal site in reports/status for more information.

**Network Identifier.

This can be found at https://insight.acquia.com/subscriptions/keys

**Network Key

This can be found at https://insight.acquia.com/subscriptions/keys

**Network Salt

Currently this can not be found yet. This requirement will be removed as soon as this API can access the
subscription information

```php
use Acquia\Search\API;

$acquia_search_service = SearchServiceClient::factory(array(
    'search_identifier' => 'ABCD-1234.test.default',
    'network_identifier' => 'ABCD-1234,
    'network_key' => 353udjf6294odd0114sl49l',
    'network_salt' => 2649eof94hkd864i3ndo92y',
));

```

Run [API commands](src/Acquia/Search/API/SearchServiceClient.php) like the
one below. All calls return JSON that is parsed into a PHP array. Refer to
the [Search Service API documentation](https://api.acquia-search.com) for
the structure of the responses.

```php
// Get basic Acquia Search Index information
$json = $acquia_search_service->index();
````

This library is compatible with the [Acquia Service Manager](https://github.com/acquia/acquia-sdk-php#the-acquia-service-manager).
The code below saves the credentials to a JSON file in the specified directory.

```php
use Acquia\Rest\ServiceManager;

$services = new ServiceManager(array(
    'conf_dir' => '/path/to/conf/dir',
));

$services->setClient('acquia-search-service', 'acquia-search-service', $acquia_search_service);
$services->save();

```

Instantiate an Acquia Search Service Client from the credentials stored in the JSON file.

```php
$acquia_search_service = $services->getClient('acquia-search-service', 'acquia-search-service');
```

## Related Projects

* [Acquia SDK for PHP](https://github.com/acquia/acquia-sdk-php)
