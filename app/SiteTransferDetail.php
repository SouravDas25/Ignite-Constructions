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

    public static function addActivity(SiteTransfer $siteTransfer,int $js,string $title,string $details,$quantity = null)
    {
        $d = new SiteTransferDetail();
        $d->site_transfer_id = $siteTransfer->id;
        $d->datetime = Carbon::now()->toDateTimeString();
        if($quantity) $d->quantity = $quantity;
        $d->journey_status = $js;
        $d->title = $title;
        $d->details = $details;
        $d->save();
        return $d;
    }

    public function toArray()
    {
        return [
            'title' => $this->title,
            'time' => Carbon::parse($this->datetime)->diffForHumans(),
            'des' => $this->details,
            'sml' =>"this is small text"
        ];
    }

}
