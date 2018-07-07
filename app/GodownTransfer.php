<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GodownTransfer extends Model
{
    protected $fillable=['godown_id','purchase_id','quantity','date'];

    public function godown()
    {
        return $this->belongsTo('App\Godown');
    }

    public function good()
    {
        return $this->belongsTo('App\Good');
    }

    public function purchase()
    {
        return $this->belongsTo('App\Purchase');
    }

    public function siteGodownTransfers()
    {
        return $this->hasMany('App\SiteGodownTransfer');
    }
}
