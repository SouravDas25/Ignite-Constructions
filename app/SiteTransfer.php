<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SiteTransfer extends Model
{
    public function site()
    {
        return $this->belongsTo('App\Site');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function labour()
    {
        return $this->belongsTo('App\Labour');
    }

    public function siteGodownTransfers()
    {
        return $this->hasMany('App\SiteGodownTransfer');
    }

    public function transferDetails()
    {
        return $this->hasMany('App\SiteTransferDetail')->orderBy('datetime');
    }

    public function goods()
    {
        return $this->siteGodownTransfers->first()->godownTransfer->goods;
    }

    public function godown()
    {
        return $this->siteGodownTransfers->first()->godownTransfer->godown;
    }

    public function transferQuantity()
    {
        return $this->siteGodownTransfers->sum('quantity');
    }

    public function addActivity(int $js,string $title,string $details,$quantity = null)
    {
        return SiteTransferDetail::addActivity($this,$js,$title,$details,$quantity);
    }

    /**
     * @param Status $status
     * @return SiteTransfer
     * @throws \Exception
     */
    private function updateStatus(Status $status)
    {
        $this->status_id = $status->id;
        $THIS = $this;
        Utility::runSqlSafely(function () use ($THIS) {
            $THIS->save();
        });
        return $this;
    }

    /**
     * @return SiteTransfer
     * @throws \Exception
     */
    public function confirmTransfer()
    {
        $details = 'Started Journey Towards Godown, Beginning Of Trip 1';
        $this->addActivity(JourneyStatus::STARTED,'Site Transfer Commenced',$details);
        $this->labour->updateActiveTransfer($this->id);
        return $this->updateStatus(Status::CONFIRMED());
    }

    /**
     * @return SiteTransfer
     * @throws \Exception
     */
    public function completeTransfer()
    {
        $details = 'Transfer Completed with ' . $this->transferDetails->count() . ' Trip(s).';
        $this->addActivity(JourneyStatus::COMPLETED,'Site Transfer Completed',$details);
        $this->labour->updateActiveTransfer(null);
        return $this->updateStatus(Status::COMPLETED());
    }

    public function isCompleted()
    {
        if($this->status->id === Status::COMPLETED()->id){
            return true;
        }
        return false;
    }

    public function isPending()
    {
        if($this->status->id === Status::PENDING()->id){
            return true;
        }
        return false;
    }

    /**
     * @return SiteTransfer
     * @throws \Exception
     */
    public function activateTransfer()
    {
        return $this->updateStatus(Status::ACTIVE());
    }

    /**
     * @param Godown $godown
     * @param Good $goods
     * @param Site $site
     * @param Labour $labour
     * @param int $quantity
     * @return bool
     * @throws \Exception
     */
    public static function newTransfer(Godown $godown, Good $goods, Site $site, Labour $labour, int $quantity)
    {
        if($quantity == 0){
            return null;
        }
        $gt = $godown->getTransferableID($goods);
        //$ids = $gt->pluck('godown_transfer_id');
        $selected = SiteTransfer::selectQuantityTransfers($gt, $quantity);
        //dd($selected);
        return SiteTransfer::saveNewTransfer($site, $labour, $selected);
    }

    /**
     * @param Site $site
     * @param Labour $labour
     * @param Carbon $date
     * @return bool
     * @throws \Exception
     */
    public function updateTransfer(Site $site = null , Labour $labour = null , Carbon $date = null)
    {
        $st = $this;
        if ($site)   $this->site_id = $site->id;
        if ($labour) $this->labour_id = $labour->id;
        if ($date)   $this->date = $date->toDateString();

        if($site || $date || $labour){
            Utility::runSqlSafely(function () use ($st) {
                $st->save();
            });
        }
        return true;
    }

    /**
     * @param Godown $godown
     * @param Good $goods
     * @param int $quantity
     * @return null
     * @throws \Exception
     */
    public function updateGoods(Godown $godown, Good $goods, int $quantity)
    {
        if($quantity == 0){
            return null;
        }
        $st = $this;
        Utility::runSqlSafely(function () use ($st) {
            SiteGodownTransfer::where('site_transfer_id', $st->id)->delete();
        });
        $gt = $godown->getTransferableID($goods);
        //$ids = $gt->pluck('godown_transfer_id');
        $selected = SiteTransfer::selectQuantityTransfers($gt, $quantity);

        Utility::runSqlSafely(function () use ($st, $selected) {
            SiteTransfer::insertSiteGodownTransfer($st, $selected);
        });
    }

    /**
     * @param int $id
     * @throws \Exception
     */
    public static function destroyTransfer(int $id)
    {
        Utility::runSqlSafely(function () use ($id) {
            SiteGodownTransfer::where('site_transfer_id', $id)->delete();
            SiteTransfer::destroy($id);
        });
    }

    /**
     * @param $godowntransfers
     * @param $quantity
     * @return array
     * @throws \Exception
     */
    private static function selectQuantityTransfers($godowntransfers, $quantity)
    {
        if($quantity == 0){
            return null;
        }
        $reachQty = $quantity;
        $selected = [];
        foreach ($godowntransfers as $gtrans) {
            $currentQty = $gtrans->receivedQty - $gtrans->sentQty;
            $item = new \stdClass();
            if ($currentQty < $reachQty) {
                $item->id = $gtrans->godown_transfer_id;
                $item->qty = $currentQty;
                array_push($selected, $item);
                $reachQty -= $currentQty;
            } else {
                $item->id = $gtrans->godown_transfer_id;
                $item->qty = $reachQty;
                array_push($selected, $item);
                $reachQty = 0;
                break;
            }
        }
        if ($reachQty > 0) {
            throw new \Exception("Not Enough Resources in Godown To Make The Transfer.");
        }
        return $selected;
    }

    /**
     *
     * @throws \Exception
     */
    private static function saveNewTransfer(Site $site, Labour $labour, $selected)
    {
        DB::beginTransaction();
        $st = new SiteTransfer();
        try {
            $st->site_id = $site->id;
            $st->date = Carbon::now()->toDateString();
            $st->labour_id = $labour->id;
            $st->status_id = Status::PENDING()->id;
            $st->save();
            SiteTransfer::insertSiteGodownTransfer($st, $selected);
        } catch (\Exception $exception) {
            DB::rollBack();
            throw  $exception;
        }
        DB::commit();
        return $st;
    }

    /**
     * @param SiteTransfer $siteTransfer
     * @param array $selected
     * @return bool
     * @throws \Exception
     */
    private static function insertSiteGodownTransfer(SiteTransfer $siteTransfer, array $selected)
    {
        foreach ($selected as $item) {
            $gst = new SiteGodownTransfer();
            $gst->site_transfer_id = $siteTransfer->id;
            $gst->godown_transfer_id = $item->id;
            $gst->quantity = $item->qty;
            $gst->save();
        }
        return true;
    }

}
