<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Spatial;

class Site extends Model
{
    use Spatial;

    public function siteTransfers()
    {
        return $this->hasMany('App\SiteTransfer');
    }

}
