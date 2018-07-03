<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    //
	
	public function goods()
	{
		return $this->belongsTo('App\Good');
	}
	
}
