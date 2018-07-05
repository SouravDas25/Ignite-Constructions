<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GodownTransfer extends Model
{
    protected $fillable=['godown_id','purchase_id','quantity','date'];

    public function godowns()
    {
        return $this->belongsTo('App\Godown','godown_id');
    }

    public function purchases()
    {
        return $this->belongsTo('App\Purchase','purchase_id');
    }
}
