<?php
namespace perspectivain\postgis\types;

/**
 * Interface for postgis type
 */
interface IType
{
    /**
     * Convert an json array in a postgis insert query
     * @param array $coordinates Coordinates
     * @param int $srid Postgis SRID
     * @return string
     */
    public function arrayToWkt($coordinates, $srid);

    /**
     * Convert an string in a array postgis
     * @param postgis text $coordinate
     * @return mixed(false, array)
     */
    public function WktToArray($coordinate);
}
