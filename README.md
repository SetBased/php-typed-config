
# Strong Typed Config

A lightweight and strong typed configuration file loader that supports PHP, INI, XML, JSON, and YAML files.

This package is a wrapper around [hassankhan/config](https://github.com/hassankhan/config). 

<table>
<thead>
<tr>
<th>Social</th>
<th>Legal</th>
<th>Release</th>
<th>Tests</th>
<th>Code</th>
</tr>
</thead>
<tbody>
<tr>
<td>
<a href="https://gitter.im/SetBased/php-typed-config?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge"><img src="https://badges.gitter.im/SetBased/php-typed-config.svg" alt="Gitter"/></a>
</td>
<td>
<a href="https://packagist.org/packages/setbased/typed-config"><img src="https://poser.pugx.org/setbased/typed-config/license" alt="License"/></a>
</td>
<td>
<a href="https://packagist.org/packages/setbased/typed-config"><img src="https://poser.pugx.org/setbased/typed-config/v/stable" alt="Latest Stable Version"/></a><br/>
</td>
<td><a href="https://travis-ci.org/SetBased/php-typed-config"><img src="https://travis-ci.org/SetBased/php-typed-config.svg?branch=master" alt="Build Status"/></a><br/>
<a href="https://scrutinizer-ci.com/g/SetBased/php-typed-config/?branch=master"><img src="https://scrutinizer-ci.com/g/SetBased/php-typed-config/badges/coverage.png?b=master" alt="Code Coverage"/></a><br/>
</td>
<td>
<a href="https://scrutinizer-ci.com/g/SetBased/php-typed-config/?branch=master"><img src="https://scrutinizer-ci.com/g/SetBased/php-typed-config/badges/quality-score.png?b=master" alt="Scrutinizer Code Quality"/></a>
</td>
</tr>
</tbody>
</table>

# Manual

## Instantiating Strong Typed Config

Creating an instance of Strong Typed Config requires passing an instance of ```Noodlehaus\Config```:
```php
use Noodlehaus\Config;
use SetBased\Config\TypedConfig;

$config = new TypedConfig(new Config('config.json'));
```

## Getting the value of a key
 
There are two flavors of methods for getting a configuration value:
* Mandatory keys (man for short). These methods will never return a null value.
* Optional keys (opt for short). These methods will return null if the key does not exists  or has value ```null```. 

All methods will try to cast the value of a key to the required type using package [setbased/helper-cast](https://github.com/SetBased/php-helper-cast/blob/master/composer.json). I.e. if the value of key is ```string(1)``` method
```getManBool``` will return ```bool(true)``` and method ```getManInt``` will return ```int(1)```. 

All methods have two arguments:
1. The key.
2. An optional default value. this value will be returned if the key does not exists or has value ```null```. 
 
The table below gives an overview of all methods for getting the value of a key. 

| Method            | Null Value          | Return Type  |
| ----------------- | ------------------- | ------------ |
| getManArray       | throws an exception | array        |
| getManBool        | throws an exception | bool         |
| getManFiniteFloat | throws an exception | float        |
| getManFloat       | throws an exception | float        |
| getManInt         | throws an exception | int          |
| getManString      | throws an exception | string       |
| getOptArray       | returns null        | array\|null  |
| getOptBool        | returns null        | bool\|null   |
| getOptFiniteFloat | returns null        | float\|null  |
| getOptFloat       | returns null        | float\|null  |
| getOptInt         | returns null        | int\|null    |
| getOptString      | returns null        | string\|null |


# Installation 

Strong Typed Config can be installed using composer:
```sh
composer require setbased/typed-config
```

License
=======

This project is licensed under the terms of the MIT license.

