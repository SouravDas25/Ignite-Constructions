<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Traits\Spatial;

class Site extends Model
{
    use Spatial;


    public function siteTransfers()
    {
        return $this->hasMany('App\SiteTransfer');
    }

    /**
     * @param $godowntransfers
     * @param $quantity
     * @return array
     * @throws \Exception
     */
    private static function selectQuantityTransfers($godowntransfers , $quantity )
    {
        $reachQty = $quantity;
        $selected = [];
        foreach ($godowntransfers as $gtrans)
        {
            $currentQty = $gtrans->receivedQty - $gtrans->sentQty;
            $item = new \stdClass();
            if($currentQty < $reachQty) {
                $item->id = $gtrans->godown_transfer_id;
                $item->qty = $currentQty;
                array_push($selected,$item);
                $reachQty -= $currentQty;
            }
            else {
                $item->id = $gtrans->godown_transfer_id;
                $item->qty = $reachQty;
                array_push($selected,$item);
                $reachQty = 0;
                break;
            }
        }
        if($reachQty > 0){
            throw new \Exception("Not Enough Resources in Godown To Make The Transfer.");
        }
        return $selected;
    }

    /**
     *
     * @throws \Exception
     */
    private static function saveNewTransfer(Site $site,Labour $labour,$selected)
    {
        DB::beginTransaction();
        try{
            $st = new SiteTransfer();
            $st->site_id = $site->id;
            $st->date = now()->toFormattedDateString();
            $st->labour_id = $labour->id;
            $st->status_id = Status::PENDING()->id;
            $st->save();
            foreach ($selected as $item){
                $gst = new SiteGodownTransfer();
                $gst->site_transfer_id = $st->id;
                $gst->godown_transfer_id = $item->id;
                $gst->quantity = $item->qty;
                $gst->save();
            }
        }
        catch (\Exception $exception){
            DB::rollBack();
            throw  $exception;
        }
        DB::commit();
    }

    public static function newTransfer(Godown $godown,Good $goods,Site $site,Labour $labour,int $quantity)
    {
        $gt = $godown->getTransferableID($goods);
        //$ids = $gt->pluck('godown_transfer_id');
        $selected = Site::selectQuantityTransfers($gt,$quantity);
        //dd($selected);
        Site::saveNewTransfer($site,$labour,$selected);
        return true;
    }

}
