<?php

namespace App\Http\Controllers;

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
        $sellers=Seller::all();
        $goods=Good::all();
        $godowns=Godown::all();
        
        return view('vendor.voyager.purchases.edit-add', compact('purchase','sellers','goods','godowns'));
    }

    public function update(Request $request , $id)
    {
        $rules = array(
            'seller_id'=>'required|numeric',
            'goods_id'=>'required|numeric',
            'quantity'       => 'required|numeric',
            'cost'      => 'required|numeric',
            'date' => 'required|date',
            'purchase_due' => 'required|numeric'
        );
        $validator = Validator::make(request()->all(), $rules);

        $purchase=Purchase::findOrFail($id);

        if ($validator->fails()) {
            return redirect()->route('voyager.purchases.show',$purchase->id)->withErrors($validator)->withInput();
        } else{
            
            $purchase->seller_id=request('seller_id');
            $purchase->goods_id=request('goods_id');
            $purchase->quantity=request('quantity');
            $purchase->cost=request('cost');
            $purchase->date=request('date');
            $purchase->purchase_due=request('purchase_due');

            $purchase->save();
            
            return redirect()->route('voyager.purchases.show',$purchase->id);
        }
    }

    public function create(Request $request)
    {
        $purchase=Purchase::all();
        $sellers=Seller::all();
        $goods=Good::all();
        $godowns=Godown::all();

        return view('vendor.voyager.purchases.edit-add', compact('purchase','sellers','goods','godowns'));
    }

    public function store(Request $request)
    {
        $rules = array(
            'seller_id'=>'required|numeric',
            'goods_id'=>'required|numeric',
            'quantity'       => 'required|numeric',
            'cost'      => 'required|numeric',
            'date' => 'required|date',
            'purchase_due' => 'required|numeric',
            'QS_godowns' => 'required'
        );
        $data = request()->validate($rules);

        $purchase=new Purchase();

        $purchase->seller_id= $data['seller_id'];
        $purchase->goods_id= $data['goods_id'];
        $purchase->quantity= $data['quantity'];
        $purchase->cost=$data['cost'];
        $purchase->date=$data['date'];
        $purchase->purchase_due=$data['purchase_due'];

        $purchase->save();

        $godowns = json_decode($data['QS_godowns']);

        foreach($godowns as $godown) {
            $godown_id = $godown->id;
            $qty = $godown->qty;
            
            $godown_transfer=new GodownTransfer();

            $godown_transfer->godown_id= $godown_id;
            $godown_transfer->purchase_id= $purchase->id;
            $godown_transfer->quantity=$qty;
            $godown_transfer->date= $purchase->date;

            $godown_transfer->save();
        }
        
        return redirect()->route('voyager.purchases.index');
        
    }

    
}
