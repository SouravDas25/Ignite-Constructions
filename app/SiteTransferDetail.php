<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SiteTransferDetail extends Model
{

    public function siteTransfer()
    {
        return $this->belongsTo('App\SiteTransfer');
    }

    public static function addActivity(SiteTransfer $siteTransfer,int $quantity,Status $status)
    {
        $d = new SiteTransferDetail();
        $d->site_transfer_id = $siteTransfer->id;
        $d->datetime = Carbon::now()->toDateTimeString();
        $d->quantity = $quantity;
        $d->status_id = $status->id;
        $d->save();
        return $d;
    }
}
