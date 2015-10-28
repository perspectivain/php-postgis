# PHP Postgis

A PHP Trait to convert Postgis coordinates to array and a PHP array to Postgis
text.

Currently supports `Point` and `Polygon` types.

## Usage
Use it as [PHP trait](http://php.net/manual/pt_BR/language.oop5.traits.php).

```php
<?php
use perspectivain\postgis\PostgisTrait;

class Customer extends ActiveRecord
{
    use PostgisTrait;
    ...
}

...

$coordinates = $model->WktToArray('Polygon', 'city_coordinates');

$model->city_coordinates = $model->arrayToWkt('Polygon', $coordinates);
```

## Installing

The preferred way to install this extension is through Composer.

```json
{
  "require": {
    "perspectivain/php-postgis": "*"
  }
}
```
