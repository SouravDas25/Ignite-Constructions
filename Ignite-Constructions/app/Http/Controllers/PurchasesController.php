<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Database\Schema\SchemaManager;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadImagesDeleted;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;
use App\Purchase;
use App\GodownTransfer;
use App\Seller;
use App\Good;
use App\Godown;

class PurchasesController extends VoyagerBaseController
{

    public function show(Request $request,$id)
    {
        $purchase=Purchase::find($id);

        return view('vendor.voyager.purchases.read', compact('purchase'));
    } 
    public function edit(Request $request , $id)
    {
        $purchase=Purchase::findOrFail($id);
        $sellers= Seller::all();
        $goods = Good::all();
        $godowns = Godown::all();
        
        return view('vendor.voyager.purchases.edit-add', compact('purchase','sellers','goods','godowns'));
    }

    public function update(Request $request , $id)
    {
        $rules = array(
            'seller_id'=>'required|numeric',
            'date' => 'required|date',
            'purchase_due' => 'required|numeric',
            'itemList' => 'required'
        );
        $data = request()->validate($rules);
        $itemList = json_decode($data['itemList']);
        $seller = Seller::findOrFail($data['seller_id']);
        $purchase = Purchase::updatePurchase($id);

        $purchase->seller($seller)
            ->due($data['purchase_due'])
            ->date(Carbon::parse($data['date']));

        foreach($itemList as $item) {
            $godown = Godown::findOrFail($item->godown_id);
            $good = Good::findOrFail($item->good_id);
            $purchase->addItem($godown, $good, $item->qty, $item->cost);
        }

        $purchase->save();

        return redirect()->route('voyager.purchases.index');
    }

    public function create(Request $request)
    {
        //$purchase=Purchase::all();
        $sellers=Seller::all();
        $goods=Good::all();
        $godowns=Godown::all();

        return view('vendor.voyager.purchases.edit-add', compact('sellers','goods','godowns'));
    }

    public function store(Request $request)
    {
        
        $rules = array(
            'seller_id'=>'required|numeric',
            'date' => 'required|date',
            'purchase_due' => 'required|numeric',
            'itemList' => 'required'
        );
        $data = request()->validate($rules);

        $itemList = json_decode($data['itemList']);
        //dd($itemList);

        $seller = Seller::findOrFail($data['seller_id']);

        $purchase = Purchase::newPurchase();
        $purchase->seller($seller)
            ->due($data['purchase_due'])
            ->date(Carbon::parse($data['date']));

        foreach($itemList as $item) {
            $godown = Godown::findOrFail($item->godown_id);
            $good = Good::findOrFail($item->good_id);
            $purchase->addItem($godown, $good, $item->qty, $item->cost);
        }

        $purchase->save();

        return redirect()->route('voyager.purchases.index');
        
    }

    public function destroy(Request $request, $id)
    {
        try {
            Purchase::deletePurchase($id);
            $data = [
                'message' => 'Successfully deleted a Purchase',
                'alert-type' => 'success',
            ];
        } catch (\Exception $e) {
            $data = [
                'message' => $e->getMessage(),
                'alert-type' => 'error',
            ];
        }
        return redirect()->route('voyager.purchases.index')->with($data);
    }


}
