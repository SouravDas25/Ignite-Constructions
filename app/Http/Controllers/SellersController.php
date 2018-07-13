<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use App\Good;
use App\Seller;


class SellersController extends VoyagerBaseController
{
    public function show(Request $request, $id)
    {
        $seller=Seller::findOrFail($id);

        $badges = $seller->broughtGoods();

        //dd($badges);

        $colorArray=['red','pink','purple','deep-purple','indigo','blue','light-blue','cyan','teal','green','light-green','lime','yellow','amber','orange','deep-orange','brown','grey','blue-grey'];

        return view('vendor.voyager.sellers.read', compact('seller','badges','colorArray'));
    }

    public function destroy(Request $request, $id)
    {
        $seller = Seller::findOrFail($id);
        $purchaseCount = Purchase::where('seller_id','=',$id)->count();
        if($purchaseCount < 1) {
            $seller->delete();
            $this->alertSuccess('Seller Deleted');
        }
        else {
            $this->alertError('Purchase Containes This Seller, Delete Denied.');
        }
        return redirect()->route('voyager.sellers.index');
    }
}
