<?php
/**
 * Created by PhpStorm.
 * User: SD
 * Date: 7/8/2018
 * Time: 5:35 PM
 */

namespace App;


use TCG\Voyager\Traits\Spatial;

trait CoordinatesTrait
{
    use Spatial;

    public function getLatLng()
    {
        $l = $this->getCoordinates();
        if(count($l) < 1) return new Coordinates(0,0);
        return new Coordinates($l[0]['lat'],$l[0]['lng']);
    }

    public function getLatLngs()
    {
        $item = $this->getCoordinates();
        $items = [];
        foreach ($item as $l){
            array_push($items,new Coordinates($l['lat'],$l['lng']));
        }
        return $items;
    }
}