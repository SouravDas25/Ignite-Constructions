<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Seller;

class Purchase extends Model
{
	protected $fillable=['seller_id','goods_id','quantity','cost','date','purchase_due'];
    public function good()
	{
		return $this->belongsTo('App\Good');
	}

	public function seller()
	{
		return $this->belongsTo('App\Seller','seller_id');
	}

	public function godownTransfer()
    {
        return $this->hasOne('App\GodownTransfer');
    }

	public function quantity()
    {
        return $this->godownTransfer->quantity;
    }
}
