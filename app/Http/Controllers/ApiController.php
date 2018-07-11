<?php

namespace App\Http\Controllers;

use App\Labour;
use App\SiteTransfer;
use App\Status;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function verifyUser(Request $request)
    {
        $userName = $request->input('email',null);
        $password = $request->input('password',null);
        if(!$userName || !$password){
            return response()->json(['status'=>'ERROR','data'=>'UserName and Password is Required']);
        }

        $labour = Labour::where('name',$userName)->first();

        if( !$labour ){
            return response()->json(['status'=>'ERROR','data'=>'Invalid UserName']);
        }
        if(!Hash::check($password, $labour->password)) {
            return response()->json(['status'=>'ERROR','data'=>'Invalid Password']);
        }

        return response()->json(['status'=>'SUCCESS','data'=> [
            'id' => $labour->id,
            'userName' => $labour->name
        ]]);
    }

    public function getTransferJob(Request $request)
    {
        $labour_id = $request->input('labour',null);
        if(!$labour_id) {
            return response()->json(['status'=>'ERROR','data' => 'Invalid Labour ID']);
        }
        $siteTransfer_id = $request->input('st_id',null);
        $labour = Labour::findOrFail($labour_id);
        $data = new \stdClass();
        $st = ($siteTransfer_id) ? SiteTransfer::findOrFail($siteTransfer_id) :
            $labour->siteTransfers->where('status_id','!=',Status::COMPLETED()->id)->first();
        if($st) {
            $data->siteTransfer_id = $st->id;
            $data->godown = [
                'id' => $st->godown()->id,
                'name' => $st->godown()->name,
                'address' => $st->godown()->address,
                'location' => $st->godown()->getLatLng(),
            ];
            $data->site = [
                'id' => $st->site->id,
                'name' => $st->site->name,
                'address' => $st->site->address,
                'location' => $st->site->getLatLng(),
            ];
            $data->goods = [
                'id' => $st->goods()->id,
                'name' => $st->goods()->name,
                'quantity' => $st->transferQuantity(),
                'details' => $st->goods()->details
            ];
        }

        return response()->json(['status'=>'SUCCESS','data' => $data]);
    }

    public function confirmTransferJob(Request $request)
    {
        $siteTransfer_id = $request->input('st_id',null);
        if(!$siteTransfer_id) {
            return response()->json(['status'=>'ERROR','data' => 'Invalid SiteTransfer ID']);
        }
        $st = SiteTransfer::findOrFail($siteTransfer_id);
        $st->confirmTransfer();
        return response()->json(['status'=>'SUCCESS','data' => 'Transfer Confirmed']);
    }

    public function completeTransferJob(Request $request)
    {
        $siteTransfer_id = $request->input('st_id',null);
        if(!$siteTransfer_id) {
            return response()->json(['status'=>'ERROR','data' => 'Invalid SiteTransfer ID']);
        }
        $st = SiteTransfer::findOrFail($siteTransfer_id);
        $st->completeTransfer();
        return response()->json(['status'=>'SUCCESS','data' => 'Transfer Completed']);
    }

    public function getTransferDetails(Request $request)
    {
        $siteTransfer_id = $request->input('st_id',null);
        if(!$siteTransfer_id) {
            return response()->json(['status'=>'ERROR','data' => 'Invalid SiteTransfer ID']);
        }
        $st = SiteTransfer::find($siteTransfer_id);
        return $st->transferDetails;
        /*return response()->json([
            'data' => [
                [
                    'title' => 'Reached Godown Location',
                    'time' => "3 hours ago",
                    'des' => " blah blah",
                    'sml' =>"this is small text"
                ],
                [
                    'title' => 'Reached Godown Location',
                    'time' => "3 hours ago",
                    'des' => " blah blah",
                    'sml' =>"this is small text"
                ],
                [
                    'title' => 'Reached Godown Location',
                    'time' => "3 hours ago",
                    'des' => " blah blah",
                    'sml' =>"this is small text"
                ],
            ],
        ]);*/
    }
}
