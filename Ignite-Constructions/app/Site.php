<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Spatial;

/**
 * @property string $location
 */
class Site extends Model
{
    use CoordinatesTrait;
    protected $spatial = ['location'];

    public function siteTransfers()
    {
        return $this->hasMany('App\SiteTransfer');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }


    public function totalCostOfGoods()
    {
        $totalCost = 0;
        foreach ($this->siteTransfers as $transfer){
            $totalCost += $transfer->getTransferCost();
        }
        return $totalCost;
    }

    public function totalPaymentAmount()
    {
        $totalAmount = 0;
        foreach ($this->payments as $payment){
            $totalAmount += $payment->amount;
        }
        return $totalAmount;
    }

    /**
     * @param string $name
     * @param Coordinates $location
     * @param string $address
     * @return Site
     * @throws \Exception
     */
    public static function newSite(string $name, Coordinates $location, string $address)
    {
        $site = new Site();
        $site->name = $name;
        $site->location = $location->toGeometry();
        $site->address = $address;
        Utility::runSqlSafely(function () use ($site) {
            $site->save();
        });
        return $site;
    }

    /**
     * @param Coordinates $location
     * @return $this
     */

    public function updateLocation(Coordinates $location)
    {
        $this->location = $location->toGeometry();
        return $this;
    }

}
