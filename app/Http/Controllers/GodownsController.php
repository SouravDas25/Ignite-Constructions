<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Database\Schema\SchemaManager;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadImagesDeleted;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;

use App\Godown;
use App\GodownTransfer;

class GodownsController extends VoyagerBaseController
{
    public function incoming($id)
    {
        $godown=Godown::findOrFail($id);
    
        return view('vendor.voyager.godowns.incoming',compact('godown'));
    }

    public function outgoing($id)
    {
        $godown=Godown::findOrFail($id);
        
        return view('vendor.voyager.godowns.outgoing',compact('godown'));
    }

    public function show(Request $request, $id)
    {
        $godown=Godown::find($id);

        return view('vendor.voyager.godowns.read', compact('godown'));
    }
}

