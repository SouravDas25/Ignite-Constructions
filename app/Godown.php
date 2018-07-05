<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Spatial;

class Godown extends Model
{
    use Spatial;

    public function godowntransfers()
    {
        return $this->hasMany('App\GodownTransfer');
    }
}
