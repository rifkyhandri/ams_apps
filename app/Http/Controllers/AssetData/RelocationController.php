<?php

namespace App\Http\Controllers\AssetData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asset_transaction;
use App\Models\Asset;
use App\Models\Audit;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class RelocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $validation_value = [
            'custodian' => 'max:50',
            'location_req' => 'max:50',
            'costcenter' => 'max:50',
            'gps_lat' => 'max:50',
            'gps_long' => 'max:50',
        ]; 
        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal mengubah data','errors' => $validator->errors()],422);
        }
        
        $data = [
            'transaction_name'=>'Relocation Request',
            'asset_id' => $request->reqasset_id,
            'tangnumber' => $request->tangnumber_reqloc,
            'change_custodian' => $request->custodian_reqloc,
            'change_location' => $request->smlocation_reqloc,
            'change_costcenter' => $request->costcenter_reqloc,
            'requester' => Auth::user()->name,
            'approval' => false,
            'transaction_date' => $request->transactions_date

        ];

        $insert = Asset_transaction::create($data);
      
        if($insert){ 
            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Request Relocation",
                "Asset_ID" => $request->reqasset_id,
                "Module_Feature" => "Asset Transaction",
                "Field_Name" => $request->smlocation_reqloc
             ];

            $audit = Audit::create($data_audit);
            return response()->json(['message'=>'Berhasil merequest data'],200);
        }else{
            return response()->json(['message'=>'Gagal menyimpan data','errors' => $insert],422);
        }
    }
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
