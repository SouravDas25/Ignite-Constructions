<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Labour extends Model
{
    use CoordinatesTrait;
    protected $spatial = ['location'];

    protected $hidden = ['location','password'];

    public function siteTransfers()
    {
        return $this->hasMany('App\SiteTransfer');
    }

    public function analyseForActivity(Coordinates $coordinates)
    {
        $transfer = SiteTransfer::find($this->activeTransfer_id);
        if($transfer && $transfer->isCompleted() == false ){
            $tracker = new TrackingAnalyser($transfer,$coordinates);
            return $tracker->analyse();
        }
        return false;
    }

    public function updateLocation(Coordinates $location)
    {
        $this->location = $location->toGeometry();
        $this->save();
        $this->analyseForActivity($location);
    }

    public function updateActiveTransfer($id)
    {
        $this->activeTransfer_id = $id;
        $this->save();
    }
}
