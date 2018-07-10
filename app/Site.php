<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Spatial;

/**
 * @property string $location
 */
class Site extends Model
{
    use CoordinatesTrait;
    protected $spatial = ['location'];

    public function siteTransfers()
    {
        return $this->hasMany('App\SiteTransfer');
    }

    /**
     * @param string $name
     * @param Coordinates $location
     * @param string $address
     * @return Site
     * @throws \Exception
     */
    public static function newSite(string $name, Coordinates $location, string $address)
    {
        $site = new Site();
        $site->name = $name;
        $site->location = $location->toGeometry();
        $site->address = $address;
        Utility::runSqlSafely(function () use ($site) {
            $site->save();
        });
        return $site;
    }

    /**
     * @param Coordinates $location
     * @return $this
     */

    public function updateLocation(Coordinates $location)
    {
        $this->location = $location->toGeometry();
        return $this;
    }

}
