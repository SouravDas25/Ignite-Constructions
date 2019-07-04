<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    public function godownTransfers()
    {
        return $this->hasMany('App\GodownTransfer','goods_id');
    }

    public function unit()
    {
        return $this->belongsTo('App\Unit');
    }

    public function totalQuantity()
    {
        return $this->godownTransfers->sum('quantity');
    }
}
