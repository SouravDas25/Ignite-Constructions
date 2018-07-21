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
use App\Site;

class SitesController extends VoyagerBaseController
{
    public function show(Request $request, $id)
    {
        $site=Site::find($id);

        return view('vendor.voyager.sites.read',compact('site'));
    }
}
