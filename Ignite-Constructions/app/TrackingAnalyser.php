<?php
/**
 * Created by PhpStorm.
 * User: SD
 * Date: 7/11/2018
 * Time: 12:19 AM
 */

namespace App;


class TrackingAnalyser
{
    public $transfer,$location,$unit;

    public function __construct(SiteTransfer $transfer,Coordinates $location)
    {
        $this->location = $location;
        $this->transfer = $transfer;
        $this->unit = 'K';
    }

    public function previousStatus()
    {
        $heading = JourneyStatus::STARTED;
        $tm = $this->transfer->transferDetails->last();
        if($tm){
            $heading = $tm->journey_status;
        }
        return $heading;
    }

    public function getDestination($heading)
    {
        $obj = JourneyStatus::isTowardsGodown($heading) ? $this->transfer->godown() : $this->transfer->site;
        return $obj->getLatLng();
    }

    private function distance($lat1, $lon1, $lat2, $lon2, $unit) {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }

    public function getDistance($location)
    {
        return $this->distance($this->location->lat,
            $this->location->lng,$location->lat,$location->lng,$this->unit);
    }

    public function handleStatus($distance,$prevStat)
    {
        if( ($prevStat === JourneyStatus::STARTED || $prevStat === JourneyStatus::LEAVING_SITE  ) && $distance <= 0.1)
        {
            $title = 'Godown Reached.';
            $details = '';
            $this->transfer->addActivity(JourneyStatus::REACHED_GODOWN,$title,$details);
        }
        elseif ($prevStat === JourneyStatus::REACHED_GODOWN && $distance >= 0.2 )
        {
            $title ='Leaving Godown';
            $details = '';
            $this->transfer->addActivity(JourneyStatus::LEAVING_GODOWN,$title,$details);
        }
        elseif ($prevStat === JourneyStatus::LEAVING_GODOWN && $distance <= 0.1 )
        {
            $title ='Reached Site';
            $details = '';
            $this->transfer->addActivity(JourneyStatus::REACHED_SITE,$title,$details);
        }
        elseif ($prevStat === JourneyStatus::REACHED_SITE && $distance >= 0.2 )
        {
            $title ='Leaving Site';
            $details = '';
            $this->transfer->addActivity(JourneyStatus::LEAVING_SITE,$title,$details);
        }
        return true;
    }

    public function analyse()
    {
        $prevStat = $this->previousStatus();
        $destination = $this->getDestination($prevStat);
        $distance = $this->getDistance($destination);
        return $this->handleStatus($distance,$prevStat);
    }
}


