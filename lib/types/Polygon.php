<?php
namespace perspectivain\postgis\types;

use Yii;
use yii\db\Expression;

class Polygon implements IType
{
    /**
     * @inheritdoc
     */
    public function arrayToPostgis($coordinates, $srid)
    {
        $strPostgis = "ST_GeomFromText('POLYGON((";

        $arrayCoordinates = [];
        foreach($coordinates as $coordinate) {
            $arrayCoordinates[] = implode(' ', array_values($coordinate));
        }

        if($arrayCoordinates[0] != $arrayCoordinates[count($arrayCoordinates) - 1]) {
            $arrayCoordinates[] = $arrayCoordinates[0]; //close polygon with first point
        }

        $strPostgis .= implode(',', $arrayCoordinates);
        $strPostgis .= "))', " . $srid . ")";

        return new Expression($strPostgis);
    }

    /**
     * @inheritdoc
     */
    public function postgisToArray($coordinate)
    {
        if(strstr($coordinate, 'POLYGON') === false) {
            return false;
        }

        $coordinates = explode(",",str_replace(['POLYGON(', ')', '('], '', $coordinate));

        if(count($coordinates) == 0) {
            return false;
        }

        $arrayCoordinates = [];
        foreach($coordinates as $latLong) {
            list($lat, $long) =  explode(' ', $latLong);
            $arrayCoordinates[] = [$long, $lat];
        }

        return $arrayCoordinates;
    }
}
