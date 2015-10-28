<?php
namespace perspectivain\postgis\types;

class Point implements IType
{
    /**
     * @inheritdoc
     */
    public function arrayToWkt($coordinates, $srid)
    {
        $strPostgis = "ST_GeomFromText('POINT(";
        $strPostgis .= implode(' ', array_values($coordinates));
        $strPostgis .= ")', " . $srid . ")";

        return $strPostgis;
    }

    /**
     * @inheritdoc
     */
    public function wktToArray($coordinate)
    {
        if (strstr($coordinate, 'POINT') === false) {
            return false;
        }

        $arrayCoordinates = explode(" ", str_replace(['POINT(', ')'], '', $coordinate));
        if (count($arrayCoordinates) == 0) {
            return false;
        }

        return $arrayCoordinates;
    }
}
