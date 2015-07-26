# Basic cache interface and adapters

[![Author](http://img.shields.io/badge/author-@rudi_theunissen-blue.svg?style=flat-square)](https://twitter.com/rudi_theunissen)
[![License](https://img.shields.io/packagist/l/rtheunissen/cache.svg?style=flat-square)](https://packagist.org/packages/rtheunissen/cache)
[![Latest Version](https://img.shields.io/packagist/v/rtheunissen/cache.svg?style=flat-square)](https://packagist.org/packages/rtheunissen/cache)
[![Build Status](https://img.shields.io/travis/rtheunissen/cache.svg?style=flat-square&branch=master)](https://travis-ci.org/rtheunissen/cache)
[![Scrutinizer](https://img.shields.io/scrutinizer/g/rtheunissen/cache.svg?style=flat-square)](https://scrutinizer-ci.com/g/rtheunissen/cache/)
[![Scrutinizer Coverage](https://img.shields.io/scrutinizer/coverage/g/rtheunissen/cache.svg?style=flat-square)](https://scrutinizer-ci.com/g/rtheunissen/cache/)

## Installation

```bash
composer require rtheunissen/cache
```

## Usage

Supported cache providers are:
    - [Doctrine - CacheProvider](https://github.com/doctrine/cache/blob/master/lib/Doctrine/Common/Cache/CacheProvider.php)
    - [Illuminate - Store](https://github.com/illuminate/contracts/blob/master/Cache/Store.php)
    - [Stash - AbstractDriver](https://github.com/tedious/Stash/blob/master/src/Stash/Driver/AbstractDriver.php)

The easiest way to create an adapter is to use the AdapterFactory.

```php
$cache = AdapterFactory::get($provider);
```
