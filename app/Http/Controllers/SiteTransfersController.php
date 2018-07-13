<?php

namespace App\Http\Controllers;

use App\Status;
use Illuminate\Http\Request;
use App\Godown;
use App\Site;
use App\Labour;
use App\Good;
use App\SiteTransfer;
use Carbon\Carbon;

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

    public function edit(Request $request, $id)
    {
        $siteTransfer = SiteTransfer::findOrFail($id);
        $godowns=Godown::all();
        $sites=Site::all();
        $goods=Good::all();
        $labours=Labour::all();
        return view('vendor.voyager.sitetransfers.edit',compact('siteTransfer','godowns','sites','goods','labours'));
    }

    public function update(Request $request, $id)
    {
        $rules = array(
            'godown_id'=>'required|numeric',
            'good_id' => 'required|numeric',
            'site_id' => 'required|numeric',
            'labour_id' => 'required|numeric',
            'quantity' => 'required|numeric',
            'date' => 'required|date'
        );

        $data = request()->validate($rules);

        $siteTransfer = SiteTransfer::findOrFail($id);

        $godown=$siteTransfer->godown();
        $good=$siteTransfer->goods();
        $transferQuantity=$siteTransfer->transferQuantity();

        $requestGodown=Godown::find($data['godown_id']);
        $requestGood=Good::find($data['good_id']);
        $requestSite=Site::find($data['site_id']);
        $requestLabour=Labour::find($data['labour_id']);
        $requestDate=Carbon::parse($data['date']);

        if($godown->id != $data['godown_id'] || $good->id != $data['good_id'] || $transferQuantity != $data['quantity'])
        {
            $siteTransfer->updateGoods($requestGodown,$requestGood,$data['quantity']);
        }

        if($siteTransfer->site->id != $data['site_id'] || $siteTransfer->labour->id != $data['labour_id'] || $siteTransfer->date != $data['date'])
        {
            $siteTransfer->updateTransfer($requestSite,$requestLabour,$requestDate);
        }

        return redirect()->route('voyager.site-transfers.index');
    }

    public function create(Request $request)
    {
        $godowns=Godown::all();
        $sites=Site::all();
        $goods=Good::all();
        $labours=Labour::all();

        return view('vendor.voyager.sitetransfers.add' , compact('godowns','sites','goods','labours'));

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $rules = array(
            'transferList'=>'required',
        );
        $data = request()->validate($rules);
        $data = json_decode($data['transferList']);


        foreach ($data as $item)
        {
            //dd($item);
            $good= Good::findOrFail($item->goods_id);
            $godown=Godown::findOrFail($item->godown_id);
            $site=Site::findOrFail($item->site_id);
            $labour=Labour::findOrFail($item->labour_id);
            $quantity = $item->quantity;
            SiteTransfer::newTransfer($godown,$good,$site,$labour,$quantity);

        }

        return redirect()->route('voyager.site-transfers.index');
    }


}
