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

class PurchasesController extends VoyagerBaseController
{

    public function edit(Request $request , $id)
    {
        $purchase=Purchase::find($id);
        $sellers=Seller::all();
        $goods=Good::all();

        return view('vendor.voyager.purchases.edit-add', compact('purchase','sellers','goods'));
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

        $purchase=Purchase::find($id);

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

        return view('vendor.voyager.purchases.edit-add', compact('purchase','sellers','goods'));
    }

    public function store(Request $request)
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

        if ($validator->fails()) {
            return redirect()->route('voyager.purchases.index')->withErrors($validator)->withInput();
        } else {
            $purchase=new Purchase();

            $purchase->seller_id=request('seller_id');
            $purchase->goods_id=request('goods_id');
            $purchase->quantity=request('quantity');
            $purchase->cost=request('cost');
            $purchase->date=request('date');
            $purchase->purchase_due=request('purchase_due');

            $purchase->save();
            
            return redirect()->route('voyager.purchases.index');
        }
    }

    
}
