<?php

namespace App\Http\Controllers;

use App\Status;
use Illuminate\Http\Request;
use App\Godown;
use App\Site;
use App\Labour;
use App\Good;
use App\SiteTransfer;

class SiteTransfersController extends Controller
{
    public function index(Request $request)
    {
        $statuses=Status::all();
        $status_id = $request->input('status',null);
        if(!$status_id)
        {
            $siteTransfers = SiteTransfer::all();
        }
        else {
            $siteTransfers = SiteTransfer::where('status_id',$status_id)->get();
        }

        return view('vendor.voyager.sitetransfers.browse',compact('siteTransfers','status_id','statuses'));
    }

    public function show(Request $request,$id)
    {
        $siteTransfer = SiteTransfer::findOrFail($id);

        //dd($siteTransfer->godown()->getLatLng());
        return view('vendor.voyager.sitetransfers.read',compact('siteTransfer'));
    }

    public function complete(Request $request,$id){
        $st = SiteTransfer::findOrFail($id);
        $st->completeTransfer();
        return redirect()->back();
    }

    public function confirm(Request $request,$id){
        $st = SiteTransfer::findOrFail($id);
        $st->confirmTransfer();
        return redirect()->back();
    }

    public function create(Request $request)
    {
        $godowns=Godown::all();
        $sites=Site::all();
        $goods=Good::all();
        $labours=Labour::all();

        return view('vendor.voyager.sitetransfers.edit-add' , compact('godowns','sites','goods','labours'));

    }

    public function store(Request $request)
    {
        $rules = array(
            'good_id'=>'required|numeric',
            'godown_id'=>'required|numeric',
            'quantity'       => 'required|numeric',
            'site_id'=>'required|numeric',
            'labour_id'=>'required|numeric'
        );
        $data = request()->validate($rules);

        $good_id=$data['good_id'];
        $godown_id=$data['godown_id'];
        $site_id=$data['site_id'];
        $labour_id=$data['labour_id'];
        $quantity=$data['quantity'];

        $good=Good::findOrFail($good_id);
        $godown=Godown::findOrFail($godown_id);
        $site=Site::findOrFail($site_id);
        $labour=Labour::findOrFail($labour_id);

        $sitetransfer=SiteTransfer::newTransfer($godown,$good,$site,$labour,$quantity);

        return redirect()->route('voyager.site-transfers.index');
    }


}
