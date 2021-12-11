<?php

namespace App\Http\Controllers\AssetData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Models\Asset; 
use App\Models\Asset_transaction;

use Haruncpi\LaravelIdGenerator\IdGenerator;

class AssetTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('asset_transactions.asset_transactions');
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
        $req = $request->id;
        $Asset = Asset::with('objdepartement')
                        ->with('objcostgroup')
                        ->with(array('objlocation'=>function($query){
                            $query->with(array('location_big'=>function($location_big){
                                $location_big->select('id','locationname');
                            },'location_sub'=>function($location_sub){
                                $location_sub->select('id','locationname_sub');
                            }));
                        }))
                        ->with('objcostcenter')
                        ->with('objcustodian')
                        ->with('objassetclass')
                        ->with('objcondition')
                        ->with('objvendor')
                        ->with('objprovider')
                        ->with('objaccount')
                        ->with('objowner')
                        ->with('objassettype')
                        ->with('objassetstatus')
                        ->find($req);
        
        return response()->json($Asset);
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

    public function disposal(Request $request){
       
        $validation_value = [
            'disposal_asset_id'     =>  'required|max:50',
            'disposal_tangnumber'   =>  'required|max:50',
            'transactions_date'     =>  'required',
            'wd_value'              =>  'required|not_in:0',
            'saleammount'           =>  'required|numeric',
            'diff'                  =>  'required',
            'accountdis'            =>  'required'
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal mengubah data','errors' => $validator->errors()],422);
        }
        
        $data = [
            'transaction_name'  =>'Disposal',
            'asset_id'          => $request->disposal_asset_id,
            'tangnumber'        => $request->disposal_tangnumber,
            'wd_value'          => $request->wd_value,
            'sale_ammount'      => $request->saleammount,
            'diff_total'        => $request->diff,
            'transfer_account'  => $request->accountdis,
            'transaction_date'  => $request->transactions_date,
            'requester'         => Auth::user()->name,
            'approval'          => false,
        ];
       
        $insert = Asset_transaction::create($data);
     
        if($insert){
            return response()->json(['message'=>'Berhasil merequest data'],200);
        }else{
            return response()->json(['message'=>'Gagal menyimpan data','errors' => $insert],422);
        }
    }

    public function writeoff(Request $request){
      
        $validation_value = [
            'reqasset_id'         =>  'required|max:50',
            'tangnumber_writeoff' =>  'required|max:50',
            'wd_value'        =>  'required|not_in:0',
            'transactions_date'   =>  'required'
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal mengubah data','errors' => $validator->errors()],422);
        }
        
        $data = [
            'transaction_name'=>'Write Off',
            'asset_id' => $request->reqasset_id,
            'tangnumber' => $request->tangnumber_writeoff,
            'wd_value' => $request->wd_value,
            'transaction_date' => $request->transactions_date,
            'requester' => Auth::user()->name,
            'approval' => false,
        ];

        $insert = Asset_transaction::create($data);
     
        if($insert){
            return response()->json(['message'=>'Berhasil merequest data'],200);
        }else{
            return response()->json(['message'=>'Gagal menyimpan data','errors' => $insert],422);
        }
    }

    public function revalue(Request $request){
       
        $validation_value = [
            'revalue_asset_id'         =>  'required|max:50',
            'revalue_tangnumber'       =>  'required|max:50',
            'wd_value'                 =>  'required|not_in:0',
            'transactions_date'        =>  'required'
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal mengubah data','errors' => $validator->errors()],422);
        }
        
        $data = [
            'transaction_name'=>'Revalue',
            'asset_id' => $request->revalue_asset_id,
            'tangnumber' => $request->revalue_tangnumber,
            'new_tangnumber' => $request->new_tagnumber,
            'wd_value' => $request->wd_value,
            'revaluation_value' => $request->revalue_after,
            'revaluation_salvage' => $request->revalue_salvage,
            'extend_year'       => $request->year,
            'extend_month'       => $request->month,
            'transaction_date' => $request->transactions_date,
            'requester' => Auth::user()->name,
            'approval' => false,
        ];

        $insert = Asset_transaction::create($data);
     
        if($insert){
            return response()->json(['message'=>'Berhasil merequest data'],200);
        }else{
            return response()->json(['message'=>'Gagal menyimpan data','errors' => $insert],422);
        }
    }
    
    public function stocktake(Request $request){
        
        $validation_value = [
            'stock_asset_id'         =>  'required|max:50',
            'stock_tangnumber'       =>  'required|max:50',
            'stock_status'           =>  'required',
            'transactions_date'      =>  'required'
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal mengubah data','errors' => $validator->errors()],422);
        }
        
        $data = [
            'transaction_name'=>'Stock Take',
            'asset_id' => $request->stock_asset_id,
            'tangnumber' => $request->stock_tangnumber,
            'change_assetclass' => $request->assetclass,
            'change_condition' => $request->condition,
            'change_tagged'       => $request->stock_tagging,
            'change_stock_opname'       => $request->stock_status,
            'transaction_date' => $request->transactions_date,
            'requester' => Auth::user()->name,
            'approval' => false,
        ];

        $insert = Asset_transaction::create($data);
     
        if($insert){
            return response()->json(['message'=>'Berhasil merequest data'],200);
        }else{
            return response()->json(['message'=>'Gagal menyimpan data','errors' => $insert],422);
        }
    }
    
}
