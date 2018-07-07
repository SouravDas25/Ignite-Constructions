<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Labour extends Model
{
    public function siteTransfers()
    {
        $this->hasMany('App\SiteTransfer');
    }
}
