<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Purchase;
use Illuminate\Support\Facades\DB;

class Seller extends Model
{

    public function purchases()
    {
        return $this->hasMany('App\Purchase');
    }

    public function broughtGoods()
    {
        $gt = DB::table('purchases')->where('seller_id',$this->id)
            ->join('godown_transfers', 'purchases.id', '=', 'godown_transfers.purchase_id')
            ->groupBy('goods_id')->select('goods_id')->get();
        //dd($gt);
        $allGoods = [];
        foreach($gt as $obj)
        {
            $g = Good::find($obj->goods_id);
            array_push($allGoods,$g);
        }
        return $allGoods;
    }
    
}
