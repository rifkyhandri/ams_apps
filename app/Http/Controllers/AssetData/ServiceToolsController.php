<?php

namespace App\Http\Controllers\AssetData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Models\Asset;
use App\Models\ServiceLog;
use App\Models\Audit;

class ServiceToolsController extends Controller
{
    //
    public function index(){
        return view('servicetools.servicetools');
    }

    public function store(Request $request){
       
        $validation_value = [
            "tangnumber"        => "required|max:50",
            "providercode"      => "max:50",
            "notes"             => "max:50",
            "servicedate"       => "max:15",
            "nextservice"       => "max:50",
            "costservice"       => "max:50",
        ];

        $validator = Validator::make($request->all(),$validation_value);
        
        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal menambah datas','errors' => $validator->errors()],422);
        }
        
        $servicelog = [
            'tangnumber'        => $request->tangnumber,
            'providercode'      => $request->providercode,
            'notes'             => $request->notes,
            'servicedate'       => $request->servicedate,
            'servicecontract'   => $request->servicecontract,
            'nextservice'       => $request->nextservice,
            'costservice'       => $request->costservice
        ];

        $service = ServiceLog::create($servicelog);
        
        if($service){
            
            $asset_update = [
                'serviceprovider'   => $request->providercode,
                'notes'             => $request->notes,
                'servicecontract'   => $request->servicecontract,
                'nextservice'       => $request->nextservice,
            ];
    
            $asset = Asset::where('tangnumber',$request->tangnumber)->update($asset_update);

            return response()->json(['message'=>'Berhasil menambah service log!'],200);
        }else{
            return response()->json(['message'=>'Gagal service log','errors' => $insert]);
        }
        
    }

}
