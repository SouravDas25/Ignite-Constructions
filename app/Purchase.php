<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Purchase extends Model
{
    protected $fillable = ['seller_id', 'cost', 'date', 'purchase_due'];


    /*
     *
     * RELATIONSHIPS
     * */

    public function seller()
    {
        return $this->belongsTo('App\Seller', 'seller_id');
    }

    public function godownTransfers()
    {
        return $this->hasMany('App\GodownTransfer');
    }

    /*
     *
     * MINING
     *
     *
     * */

    public  function allGoods()
    {
        $gt = GodownTransfer::where('purchase_id',$this->id)->groupBy('goods_id')->get();
        $allGoods = [];
        foreach ($gt as $transfer) {
            array_push($allGoods, $transfer->goods);
        }
        return $allGoods;
    }

    public static function getAmountSpentOnMonth($month,$year)
    {
        $data = DB::select("SELECT SUM(cost*quantity) AS AMOUNT , MONTH(date) , YEAR(date) 
                    FROM `godown_transfers` JOIN purchases ON purchase_id = purchases.id 
                    WHERE MONTH(date) = $month AND YEAR(date) = $year");
        if(count($data) > 0){
            return $data[0]->AMOUNT ;
        }
        return 0;
    }


    /*
     * CRUD FUNCTIONS
     *
     *
     *
     *
     * */

    public static function newPurchase()
    {
        return new PurchaseBuilder();
    }

    public static function updatePurchase($id)
    {
        Purchase::findOrFail($id);
        return new PurchaseBuilder($id);
    }

    /**
     * @param $id
     * @throws \Exception
     */
    public static function deletePurchase($id)
    {
        Purchase::findOrFail($id);
        Utility::runSqlSafely(function () use ($id) {
            Purchase::deleteGodownTransfers($id);
            Purchase::destroy($id);
        });
    }

    public static function deleteGodownTransfers(int $id)
    {
        GodownTransfer::where('purchase_id', $id)->delete();
    }



}

class PurchaseBuilder
{
    private $items, $puchase, $id;

    public function __construct(int $id = null)
    {
        $this->id = $id;
        $this->puchase = $id != null ? Purchase::findOrFail($id) : new Purchase();
        $this->items = [];
        /*foreach ($this->puchase->godownTransfers as $gt){
            $item = new \stdClass();
            $item->id = $gt->id;
            $item->godown = $gt->godown;
            $item->goods = $gt->goods;
            $item->quantity = $gt->quantity;
            $item->cost = $gt->cost;
            array_push($this->items,$item);
        }*/
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

    public function addItem(Godown $godown, Good $goods, int $quantity, float $cost)
    {
        $item = new \stdClass();
        $item->godown = $godown;
        $item->goods = $goods;
        $item->quantity = $quantity;
        $item->cost = $cost;
        array_push($this->items, $item);
        return $this;
    }

    /*public function delIndex(int $index)
    {
        if($index)unset($this->items[$index]);
        return $this;
    }

    public function delTransfer(GodownTransfer $transfer)
    {
        $index = null;
        $i = 0;
        foreach ($this->items as $item){
            if($item->id && $item->id == $transfer->id)
            {
                $index = $i;
                break;
            }
            $i++;
        }
        return $this->delIndex($index);
    }*/

    /**
     * @throws \Exception
     */
    public function save()
    {
        $id = $this->id;
        $purchase = $this->puchase;
        $items = $this->items;
        Utility::runSqlSafely(function () use ($purchase, $items, $id) {
            if ($id != null) Purchase::deleteGodownTransfers($id);
            $purchase->save();
            foreach ($items as $item) {
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
