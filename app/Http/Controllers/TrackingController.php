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
        $data = $request->validate([
            'lat' => 'required',
            'lng' => 'required',
            'labour' => 'required',
        ]);
        $labour = Labour::findOrFail($data['labour']);
        $location = new Coordinates($data['lat'],$data['lng']);
        $labour->updateLocation($location);
        event(new SendLocation($labour,$location));
        return response()->json(['status'=>'success', 'data'=>$location]);
    }
}
