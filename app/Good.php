<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    public function godownTransfers()
    {
        return $this->hasMany('App\GodownTransfer');
    }
}
