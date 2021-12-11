<?php

namespace App\Http\Controllers\AssetData;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Asset_transaction;
use App\Models\Asset;
use App\Models\Audit;

use Yajra\Datatables\Datatables;

class ApprovalTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('asset_transactions/approvaltransaction');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $approve = Asset_transaction::with('approveasset')
                                        ->with('approvecostcenter')
                                        ->with('approvecustodian')
                                        ->with(array('approvelocation'=>function($query){
                                            $query->with(array('location_big'=>function($location_big){
                                                $location_big->select('id','locationname');
                                            },'location_sub'=>function($location_sub){
                                                $location_sub->select('id','locationname_sub');
                                            }));
                                        }))->get();

        return Datatables::of($approve)
                            ->editColumn('created_at', function($date) {
                               return $date->created_at->format('Y-m-d');
                            })
                            ->make(true);
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

    public function update_writeoff(Request $request){
      
        $validation_value = [
            'reqasset_id'         =>  'required|max:50',
            'tangnumber_writeoff' =>  'required|max:50',
            'wd_value'            =>  'required|gt:0',
            'transactions_date'   =>  'required'
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal mengubah data','errors' => $validator->errors()],422);
        }
        
        $asset_update = [
            'purchaseacq'   => $request->wd_value,
            'last_transactions' => "Write Off"
        ];

        $update = Asset::where('asset_id',$request->reqasset_id)->update($asset_update);
        
        if($update){
            
            $transcation_update = Asset_transaction::where('id_asset_transaction',$request->id_asset_transaction)->update(['approval' => true,'approver'=> Auth::user()->name]);
            
            return response()->json(['message'=>'Berhasil merubah data'],200);
        }else{
            return response()->json(['message'=>'Gagal merubah data','errors' => $update],422);
        }
    }

    public function update_disposal(Request $request,$id){
        
         $validation_value = [
            'disposal_asset_transaction_id'   =>  'required|max:50',
            'disposal_asset_id'               =>  'required|max:50',
            'disposal_tangnumber'             =>  'required|max:50',
            'transactions_date'               =>  'required',
            'wd_value'                        =>  'required|gt:0',
            'saleammount'                     =>  'required',
            'diff'                            =>  'required',
            'accountdis'                      =>  'required',
        ];

        $validator = Validator::make($request->all(),$validation_value);
      
        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal mengubah data','errors' => $validator->errors()],422);
        }
        
        $asset_update = [
            'purchaseacq'   => $request->diff,
            'account'       => $request->accountdis,
            'last_transactions' => "Disposal"
        ];

        $update = Asset::where('asset_id',$request->disposal_asset_id)->update($asset_update);
    
        if($update){
            
            $transcation_update = Asset_transaction::where('id_asset_transaction',$request->disposal_asset_transaction_id)->update(['approval' => true,'approver'=> Auth::user()->name]);
            
            return response()->json(['message'=>'Berhasil merubah data'],200);
        }else{
            return response()->json(['message'=>'Gagal merubah data','errors' => $update],422);
        }
    }

    public function update_revalue(Request $request,$id){
       
        $validation_value = [
           'revalue_asset_transaction_id'   =>  'required|max:50',
           'revalue_asset_id'               =>  'required|max:50',
           'revalue_tangnumber'             =>  'required|max:50',
           'transactions_date'               =>  'required',
           'wd_value'                        =>  'required|gt:0',
       ];

       $validator = Validator::make($request->all(),$validation_value);
     
       if ($validator->fails()) {
           return response()->json(['message'=>'Gagal mengubah data','errors' => $validator->errors()],422);
       }

       $curret_asset = Asset::find($request->revalue_asset_id);
       
       $asset_update = [
           'purchaseacq'        => $request->revalue_after,
           'salvage1'           => $request->revalue_salvage,
           'old_tagnumber'      => $request->revalue_tangnumber,
           'lifetimeyear'       => $curret_asset->lifetimeyear + $request->year,
           'livetimemonth'      => $curret_asset->livetimemonth + $request->month,
           'last_transactions'  => "Revalue"
        ];
        
        if(!empty($request->new_tagnumber)){
            $asset_update += [ 'tangnumber'         => $request->new_tagnumber ];
        }
        
       $update = Asset::where('asset_id',$request->revalue_asset_id)->update($asset_update);
   
       if($update){

            $after = Asset::find($request->revalue_asset_id);

            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Updated Asset Register",
                "Asset_ID" => $request->revalue_asset_id,
                "Module_Feature" => "Asset Register",
                "OldValue_Remark" => $curret_asset,
                "NewValue_Remark" => $after,
            ];

            $audit = Audit::firstOrCreate(['Asset_ID'=>$request->revalue_asset_id,"UserID" => Auth::user()->name,'Action_Activity'=> 'Updated Asset Register'],$data_audit);
            
            if(!empty($audit->Asset_ID)){
                $audit->update($data_audit);
            }
           
           $transcation_update = Asset_transaction::where('id_asset_transaction',$request->revalue_asset_transaction_id)->update(['approval' => true,'approver'=> Auth::user()->name]);
           
           return response()->json(['message'=>'Berhasil merubah data'],200);
       }else{
           return response()->json(['message'=>'Gagal merubah data','errors' => $update],422);
       }
   }

   public function update_stocktake(Request $request,$id){
      
        $validation_value = [
           'stock_asset_transaction_id'   =>  'required|max:50',
           'stock_asset_id'               =>  'required|max:50',
           'stock_tangnumber'             =>  'required|max:50',
           'transactions_date'               =>  'required',
       ];

       $validator = Validator::make($request->all(),$validation_value);
     
       if ($validator->fails()) {
           return response()->json(['message'=>'Gagal mengubah data','errors' => $validator->errors()],422);
       }

       $curret_asset = Asset::find($request->revalue_asset_id);
       
       $asset_update = [
           'assetclass'         => $request->assetclass,
           'asCondition'        => $request->condition,
           'stock_opname'       => $request->stock_status,
           'tagged'             => $request->stock_tagging,
           'last_transactions'  => "Stock Take"
       ];
        
       $update = Asset::where('asset_id',$request->stock_asset_id)->update($asset_update);
   
       if($update){
            
            $after = Asset::find($request->revalue_asset_id);

            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Updated Asset Register",
                "Asset_ID" => $request->stock_asset_id,
                "Module_Feature" => "Asset Register",
                "OldValue_Remark" => $curret_asset,
                "NewValue_Remark" => $after,
            ];

            $audit = Audit::firstOrCreate(['Asset_ID'=>$request->stock_asset_id,"UserID" => Auth::user()->name,'Action_Activity'=> 'Updated Asset Register'],$data_audit);
            
            if(!empty($audit->Asset_ID)){
                $audit->update($data_audit);
            }

           $transcation_update = Asset_transaction::where('id_asset_transaction',$request->stock_asset_transaction_id)->update(['approval' => true,'approver'=> Auth::user()->name]);
           
           return response()->json(['message'=>'Berhasil merubah data'],200);
       }else{
           return response()->json(['message'=>'Gagal merubah data','errors' => $update],422);
       }
   }
}
