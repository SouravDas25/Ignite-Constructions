<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Traits\Spatial;

class Godown extends Model
{
    use Spatial;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function godownTransfers()
    {
        return $this->hasMany('App\GodownTransfer');
    }

    public function hasGoods(Good $goods, $quantity = null)
    {
        $data = $this->godownPurchases()->where('goods_id', $goods->id)->sum('quantity');
        $data -= $this->godownSiteTransfers()->where('goods_id', $goods->id)->sum('site_godown_transfers.quantity');
        if ($quantity) return $quantity <= $data;
        return $data;
    }

    private function godownPurchases()
    {
        $query = DB::table('godown_transfers');
        $query->join('purchases', 'godown_transfers.purchase_id', '=', 'purchases.id')
            ->where('godown_id', $this->id);
        return $query;
    }

    private function godownSiteTransfers()
    {
        $query = DB::table('site_godown_transfers');
        $query->join('godown_transfers', 'site_godown_transfers.godown_transfer_id', '=', 'godown_transfers.id')
            ->join('purchases', 'godown_transfers.purchase_id', '=', 'purchases.id')
            ->where('godown_id', $this->id);
        return $query;
    }

    public function getTransferableID(Good $goods)
    {
        $data = DB::table('godown_transfers')
            ->leftJoin('site_godown_transfers', 'godown_transfers.id', '=', 'site_godown_transfers.godown_transfer_id')
            ->join('purchases', 'godown_transfers.purchase_id', '=', 'purchases.id')
            ->where('godown_id', $this->id)
            ->where('goods_id', $goods->id)
            ->groupBy('godown_transfers.id')
            ->orderBy('godown_transfers.created_at')
            ->havingRaw('sentQty < receivedQty || sentQty IS NULL')
            ->selectRaw('godown_transfers.id AS godown_transfer_id, godown_transfers.quantity AS receivedQty, SUM(site_godown_transfers.quantity) AS sentQty')
            ->get();
        $data->each(function ($item) {
            $item->sentQty = (int)$item->sentQty;
        });
        return $data;
    }

}
