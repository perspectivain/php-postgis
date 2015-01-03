<?php
namespace perspectivain\yii2-postgis;

use Yii;
use yii\helpers\Json;
use yii\db\ActiveRecord as YiiActiveRecord;

class ActiveRecord extends YiiActiveRecord
{
    /**
     * Supported postgis types
     * @var array
     */
    private $_types = ['Point', 'Polygon'];

    /**
     * Convert an json array in a postgis insert query
     * @param string $type Object postgis type
     * @param json $coordinates Coordinates in json format
     * @return \yii\db\Expression
     */
    protected function arrayToPostgis($type, $coordinates, $srid = 4326)
    {
        if(!in_array($type, $this->_types)) {
            return false;
        }

        $class = '\Postgis\types\\' . $type;
        $objectType = new $class;
        if(!$objectType) {
            return false;
        }

        $object->setArrayCoordinates($coordinates);

        return $objectType->arrayToPostgis($coordinates, $srid);
    }

    /**
     * Convert an string in a array postgis
     * @param string $type Object postgis type
     * @param string $attribute Attribute to load in AR database
     * @return mixed(false, array)
     */
    protected function postgisToArray($type, $attribute)
    {
        if(!in_array($type, $this->_types)) {
            return false;
        }

        if(!self::hasAttribute($attribute)) {
            return false;
        }

        $class = '\Postgis\types\\' . $type;
        $objectType = new $class;
        if(!$objectType) {
            return false;
        }

        $objectAR = self::find()
            ->select('ST_asText(' . $attribute . ') as ' . $attribute)
            ->where(['id' => $this->id])
            ->one();

        if(!$objectAR instanceof self) {
            return false;
        }

        return $objectType->postgisToArray($objectAR->coordenadas_area);
    }
}
