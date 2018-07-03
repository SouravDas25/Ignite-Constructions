<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Seller;

class Purchase extends Model
{
	protected $fillable=['seller_id','goods_id','quantity','cost','date','purchase_due'];
    public function goods()
	{
		return $this->belongsTo('App\Good');
	}

	public function sellers()
	{
		return $this->belongsTo('App\Seller','seller_id');
	}
}
