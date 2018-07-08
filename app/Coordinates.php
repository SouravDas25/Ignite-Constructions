<?php
/**
 * Created by PhpStorm.
 * User: SD
 * Date: 7/7/2018
 * Time: 2:11 PM
 */

namespace App;


use Illuminate\Support\Facades\DB;

class Coordinates
{
    public $lat,$lng ;

    public function __construct(float $lat,float $lng)
    {
        $this->lat = $lat;
        $this->lng = $lng;
    }

    public function toGeometry()
    {
        $lat = (float) $this->lat;
        $lng = (float) $this->lng;

        return DB::raw("ST_GeomFromText('POINT({$lng} {$lat})')");
    }

    public static  function newCoordinate($latitude,$longitude)
    {
        return new \App\Coordinates($latitude,$longitude);
    }

}