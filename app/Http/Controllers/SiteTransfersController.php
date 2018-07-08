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
use App\Godown;
use App\Site;
use App\Labour;
use App\Good;
use App\SiteTransfer;

class SiteTransfersController extends VoyagerBaseController
{
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

    public function index(Request $request)
    {
        return view('vendor.voyager.sitetransfers.browse');
    }
}
