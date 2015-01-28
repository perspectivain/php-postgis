PHP Postgis
=======
A PHP Trait to convert postgis coordinates to array and array to postgis text

Currently support Point and Polygon types.

Usage
=======
Use as PHP trait (http://php.net/manual/pt_BR/language.oop5.traits.php)

```
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

Installing
======
The preferred way to install this extension is through composer.

```
{
  "require": {
    "perspectivain/yii2-postgis-behavior": "*"
  }
}
```
