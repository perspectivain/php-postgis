Postgis
=======
A Yii2 library to convert postgis coordinates to array and array to postgis text

Usage
=======
Extend your AR model to postgis AR and use yout methods

```
<?php
use Postgis\ActiveRecord as PostgisActiveRecord;

class Customer extends PostgisActiveRecord {
  ...
}
```

Installing
======
Via composer

```
{
  "require": {
    "perspectivain/postgis": "*"
  }
}
```
```
