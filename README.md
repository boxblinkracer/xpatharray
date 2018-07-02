XPathArray - Easy XPath Access for your Arrays
=================

[![Downloads](https://img.shields.io/packagist/dt/boxblinkracer/xpatharray.svg?style=flat-square)](https://packagist.org/packages/boxblinkracer/xpatharray)
[![Latest stable version](https://img.shields.io/packagist/v/boxblinkracer/xpatharray.svg?style=flat-square)](https://packagist.org/packages/boxblinkracer/xpatharray)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/boxblinkracer/xpatharray.svg?style=flat-square)](./composer.json)
[![GitHub stars](https://img.shields.io/github/stars/boxblinkracer/xpatharray.svg?style=flat-square&label=Stars&style=flat-square)](https://github.com/boxblinkracer/xpatharray/stargazers)
[![MIT licensed](https://img.shields.io/github/license/boxblinkracer/xpatharray.svg?style=flat-square)](https://github.com/boxblinkracer/xpatharray/blob/master/LICENSE)


## Why XPathArrays instead of Arrays?
...small and simple, but still powerful...
If you use basic Arrays in PHP you are familiar with the `array_key_exists` functions.
This blows up your code if you have multiple levels within your array.
If you don't do this, the only thing you get is a `PHP Notice Error`, and that obviously doesn't 
result in an Exception.

With XPathArray you get the following:

* Easy `xpath selection` in multiple levels (/customer/address/street, ...)
* Real `XPathKeyNotFound Exceptions` instead of Notices
* `Default-Values` for missing keys or values.
* ...and a more lightweight code...:)


## Installation
This package uses Composer, please checkout the [composer website](https://getcomposer.org) for more information.

The following command will install `xpatharray` into your project. 
It will also add a new entry in your `composer.json` and update the `composer.lock` as well.

```bash
$ composer require boxblinkracer/xpatharray
```

> This package follows the PSR-4 convention names for its classes, which means you can easily integrate `xpatharray` classes loading in your own autoloader.



## What now?
Here are a few examples what to do with XPathArray objects:

```php
<?php
//...
$customer = ...

# xpath array with / as our delimiter
$xCustomer = new XPathArray('/', $customer);

# object/array access with XPathNotFoundException
/** @var array @address */
$address = $xCustomer->get('/address');

# multi level access
/** @var string $phoneMobile */
$phoneMobile = $xCustomer->get('/contact/phone/mobile');

# object access with optional default value (no exception)
$street = $xCustomer->get('/street', '-');

# type safe access with optional default values
$street = $xCustomer->getString('/street', '-');
$streetNumber = $xCustomer->getInt('/streetNr', 0);
$isCompany = $xCustomer->getBool('/isCompany', false);
$customerRevenue = $xCustomer->getFloat('/revenue/total', 0.0);
```



## Copying / License
This repository is distributed under the MIT License (MIT). You can find the whole license text in the [LICENSE](LICENSE) file.