<?php

namespace App\Http\Controllers\AssetData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Asset_transaction;
use App\Models\Asset;
use App\Models\Audit;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use Yajra\Datatables\Datatables;

class ApprovalTransactionRelocationController extends Controller
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
        //
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
    public function edit(Request $request,$id)
    {
        $data = Asset_transaction::with('approveasset')
                                    ->with('approvecostcenter')
                                    ->with('approvecustodian')
                                    ->with('approveaccount')
                                    ->with('approveassetclass')
                                    ->with('approvecondition')
                                    ->with(array('approvelocation'=>function($query){
                                        $query->with(array('location_big'=>function($location_big){
                                            $location_big->select('id','locationname');
                                        },'location_sub'=>function($location_sub){
                                            $location_sub->select('id','locationname_sub');
                                        }));
                                    }))->find($request->id);
       
        return response()->json($data);
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
        $asset_update = [
            'location'          => $request->smlocation_reqloc,
            'costcenter'        => $request->costcenter_reqloc,
            'custodian'         => $request->custodian_reqloc,
            'last_transactions' => "Relocation"
        ];
        
        $current_asset = Asset::find($request->asset_id);

        $update = Asset::where('asset_id',$request->asset_id)->update($asset_update);
        
        if($update){

            $after = Asset::find($request->asset_id);

            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Updated Asset Register",
                "Asset_ID" => $request->asset_id,
                "Module_Feature" => "Asset Register",
                "OldValue_Remark" => $current_asset,
                "NewValue_Remark" => $after,
            ];

            $audit = Audit::firstOrCreate(['Asset_ID'=>$request->asset_id,"UserID" => Auth::user()->name,'Action_Activity'=> 'Updated Asset Register'],$data_audit);
            
            if(!empty($audit->Asset_ID)){
                $audit->update($data_audit);
            }

            Asset_transaction::where('id_asset_transaction',$request->id_asset_transaction)->update([
                'approval'=>1
           ]);    
            return response()->json(['message'=>'Berhasil Relocation'],200);
        }else{
            return response()->json(['message'=>'Gagal mengupdate data','errors' => $update]);
        }
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $Relocation = Asset_transaction::find($id);
        $Relocation = $Relocation->delete();
        if($Relocation){  

            return response()->json(['message'=>'Berhasil menghapus data terkait.'],200);
        }else{
            return response()->json(['message'=>'Gagal menghapus data terkait.'],422);
        }
    }
}
