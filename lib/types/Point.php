<?php

namespace app\extensions\postgis\types;

use Yii;
use \IntlDateFormatter;
use yii\db\Expression;

class Point implements IType
{
    /**
     * @inheritdoc
     */
    public function arrayToPostgis($coordinates, $srid)
    {
        $strPostgis = "ST_GeomFromText('POINT((";
        $strPostgis .= implode(' ', array_values($coordinates));
        $strPostgis .= "))', " . $srid . ")";

        return new Expression($strPostgis);
    }

    /**
     * @inheritdoc
     */
    public function postgisToArray($coordinate)
    {
        if(strstr($coordinate, 'POINT') === false) {
            return false;
        }

        $arrayCoordinates = explode(" ", str_replace(['POINT(', ')'], '', $coordinate));
        if(count($arrayCoordinates) == 0) {
            return false;
        }

        return $arrayCoordinates;
    }
}
