<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteGodownTransfer extends Model
{
    public function siteTransfer()
    {
        return $this->belongsTo('App\SiteTransfer');
    }

    public function godownTransfer()
    {
        return $this->belongsTo('App\GodownTransfer');
    }

    public function purchase()
    {
        return $this->godownTransfer->purchase;
    }
}
