<?php
namespace perspectivain\postgis\trait;

class PostgisTrait extends Behavior
{
    /**
     * Supported postgis types
     * @var array
     */
    private $_types = ['Point', 'Polygon'];

    /**
     * Convert an json array in a postgis insert query
     * @param string $type Object postgis type
     * @param array $coordinates Coordinates in json format
     * @return \yii\db\Expression
     */
    public function WktToArray($type, $coordinates, $srid = 4326)
    {
        if(!in_array($type, $this->_types)) {
            return false;
        }

        $class = '\perspectivain\postgis\types\\' . $type;
        $objectType = new $class;
        if(!$objectType) {
            return false;
        }

        return $objectType->arrayToPostgis($coordinates, $srid);
    }

    /**
     * Convert an string in a array postgis
     * @param string $type Object postgis type
     * @param string $attribute Attribute to load in AR database
     * @return mixed(false, array)
     */
    public function arrayToWkt($type, $attribute)
    {
        if(!in_array($type, $this->_types)) {
            return false;
        }

        if(!self::hasAttribute($attribute)) {
            return false;
        }

        $class = '\perspectivain\postgis\types\\' . $type;
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

        return $objectType->postgisToArray($objectAR->$attribute);
    }
}
