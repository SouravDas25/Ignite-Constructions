<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Labour extends Model
{
    use CoordinatesTrait;
    protected $spatial = ['location'];

    protected $hidden = ['location','password'];

    public function siteTransfers()
    {
        return $this->hasMany('App\SiteTransfer');
    }

    public function updateLocation(Coordinates $location)
    {
        $this->location = $location->toGeometry();
    }
}
