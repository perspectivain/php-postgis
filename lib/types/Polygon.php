<?php
namespace perspectivain\postgis\types;

class Polygon implements IType
{
    /**
     * @inheritdoc
     */
    public function arrayToWkt($coordinates, $srid)
    {
        $strPostgis = "ST_GeomFromText('POLYGON((";

        $arrayCoordinates = [];
        foreach ($coordinates as $coordinate) {
            $arrayCoordinates[] = implode(' ', array_values($coordinate));
        }

        // Close polygon with first point
        if ($arrayCoordinates[0] != $arrayCoordinates[count($arrayCoordinates) - 1]) {
            $arrayCoordinates[] = $arrayCoordinates[0];
        }

        $strPostgis .= implode(',', $arrayCoordinates);
        $strPostgis .= "))', " . $srid . ")";

        return $strPostgis;
    }

    /**
     * @inheritdoc
     */
    public function wktToArray($coordinate)
    {
        if (strstr($coordinate, 'POLYGON') === false) {
            return false;
        }

        $coordinates = explode(",", str_replace(['POLYGON(', ')', '('], '', $coordinate));

        if (count($coordinates) == 0) {
            return false;
        }

        $arrayCoordinates = [];
        foreach ($coordinates as $latLong) {
            $arrayCoordinates[] = explode(' ', $latLong);
        }

        return $arrayCoordinates;
    }
}
