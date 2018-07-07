<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
	protected $fillable=['seller_id','cost','date','purchase_due'];

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

    public static function newPurchase()
    {
        return new PurchaseBuilder();
    }

}

class PurchaseBuilder
{
    private $items,$puchase;

    public function __construct()
    {
        $this->puchase = new Purchase();
        $this->items = [];
    }

    public function seller(Seller $seller)
    {
        $this->puchase->seller_id = $seller->id;
        return $this;
    }

    public function date(Carbon $date)
    {
        $this->puchase->date = $date->toDateString();
        return $this;
    }

    public function due(float $due)
    {
        $this->puchase->purchase_due = $due;
        return $this;
    }

    public function addItem(Godown $godown,Good $goods,int $quantity,float $cost)
    {
        $item = new \stdClass();
        $item->godown = $godown;
        $item->goods = $goods;
        $item->quantity = $quantity;
        $item->cost = $cost;
        array_push($this->items,$item);
        return $this;
    }

    /**
     * @throws \Exception
     */
    public function save()
    {
        $purchase = $this->puchase;
        $items = $this->items;
        Utility::runSqlSafely(function () use ($purchase,$items) {
            $purchase->save();
            foreach ($items as $item){
                $gt = new GodownTransfer();
                $gt->godown_id = $item->godown->id;
                $gt->purchase_id = $purchase->id;
                $gt->goods_id = $item->goods->id;
                $gt->quantity = $item->quantity;
                $gt->cost = $item->cost;
                $gt->save();
            }
        });
    }


}
