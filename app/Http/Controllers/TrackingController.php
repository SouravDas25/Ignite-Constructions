<?php

namespace App\Http\Controllers;

use App\Coordinates;
use App\Events\SendLocation;
use App\Labour;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateLocation(Request $request)
    {
        $labour_id = $request->input('labour',null);
        $lat = $request->input('lat',null);
        $lng = $request->input('lng',null);
        if($labour_id === null) return response()->json(['status'=>'ERROR','data'=>'Labour ID not found']);
        if($lat === null || $lng === null )return response()->json(['status'=>'ERROR','data'=>'Location Incorrect']);
        $labour = Labour::findOrFail($labour_id);
        $location = new Coordinates($lat,$lng);
        event(new SendLocation($labour,$location));
        $labour->updateLocation($location);
        return response()->json(['status'=>'success', 'data'=> $location ]);
    }
}
