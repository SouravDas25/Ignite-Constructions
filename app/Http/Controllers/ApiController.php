<?php

namespace App\Http\Controllers;

use App\Labour;
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
            return response()->json([]);
        }
        $labour = Labour::findOrFail($labour_id);
        $data = new \stdClass();
        $st = $labour->siteTransfers->first();
        if($st) {
            $data->status = "SUCCESS";
            $data->godown = [
                'id' => $st->godown()->id,
                'name' => $st->godown()->name,
                'location' => $st->godown()->getLatLng(),
            ];
            $data->site = [
                'id' => $st->site->id,
                'name' => $st->site->name,
                'location' => $st->site->getLatLng(),
            ];
            $data->goods = [
                'id' => $st->goods()->id,
                'name' => $st->goods()->name,
                'quantity' => $st->transferQuantity(),
            ];
        }

        return response()->json(['data' => $data]);
    }
}
