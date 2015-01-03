<?php
namespace perspectivain\yii2-postgis\types;

/**
 * Interface for postgis type
 */
interface IType
{
    /**
     * Convert an json array in a postgis insert query
     * @param array $coordinates Coordinates
     * @param int $srid Postgis SRID
     * @return \yii\db\Expression
     */
    public function arrayToPostgis($coordinates, $srid);

    /**
     * Convert an string in a array postgis
     * @param postgis text $coordinate
     * @return mixed(false, array)
     */
    public function postgisToArray($coordinate);
}
