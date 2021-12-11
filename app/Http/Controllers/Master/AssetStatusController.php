<?php

namespace App\Http\Controllers\Master;

use App\Exports\AssetStatusExport;
use App\Imports\AssetStatusImport;
use App\Models\AssetStatus;
use App\Models\Audit;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class AssetStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('master/assetstatus_views/assetstatus');
    }
    public function import_excel(Request $request) 
	{
		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
	    // tangkap file dan import
	// tangkap file dan import
    $import = Excel::toArray(new AssetStatusImport, request()->file('file'));
    collect(head($import))->each(function ($row) { 
    AssetStatus::where('id_statusasset',$row['id_status_asset'])->update([
        'id_statusasset'=>$row['id_status_asset'],
            'description'=>$row['description'],
        ]);
    });
    Excel::import(new AssetStatusImport,request()->file('file'));
        if($import){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('d-m-Y H:i:s');
            $data_audit = [
                "ChangedDateandTime" =>$date,
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Import Asset Status",
                "Module_Feature" => "Master Asset Status",
            ];

            $audit = Audit::create($data_audit);

            return redirect()->back();
        }else{
            return response()->json(['message'=>'Gagal menambah data','errors' => $import]);
        }
	}
    public function export(){
        return Excel::download(new AssetStatusExport, 'AssetStatus.xlsx');
    }
    public function print(){
        $data = AssetStatus::all();
        return view('master/assetstatus_views/assetstatus_print',['assetstatus_print'=>$data]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $AssetStatus = AssetStatus::get();

        return Datatables::of($AssetStatus)->make(true);
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
            "statuscode"          => "required|unique:db_statusasset,id_statusasset|max:30",
            "statusdesc"           => "required|max:50",
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal menambah data','errors' => $validator->errors()],422);
        }

        $data = [
            "id_statusasset"           => $request->statuscode,
            "description"              => $request->statusdesc,
        ];
       
        $insert = AssetStatus::create($data);

        if($insert){

            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Create Asset Status",
                "Asset_ID" => $request->statuscode,
                "Module_Feature" => "Master Asset Status",
            ];

            $audit = Audit::create($data_audit);

            return response()->json(['message'=>'Berhasil menambah data!'],200);
        }else{
            return response()->json(['message'=>'Gagal menambah data','errors' => $insert]);
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
    public function edit(Request $request,$id)
    {
        $AssetStatus = AssetStatus::find($request->id);

        return response()->json($AssetStatus);
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
        $validation_value = [
            "statuscode"           =>   [
                                            'required',
                                            'max:30',
                                            Rule::unique('db_statusasset','id_statusasset')->ignore($request->id),
                                        ],
             "statusdesc"           => "required|max:50",
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal mengubah data','errors' => $validator->errors()],422);
        }

        $data = [
            "id_statusasset"           => $request->statuscode,
            "description"           => $request->statusdesc,
        ];
        
        $update = AssetStatus::where('id',$request->id)->update($data);

        if($update){
            
            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Edit Asset Status",
                "Asset_ID" => $request->statuscode,
                "Module_Feature" => "Master Asset Status",
        
            ];

            $audit = Audit::create($data_audit);

            return response()->json(['message'=>'Berhasil mengubah data!'],200);
        
        }else{
            return response()->json(['message'=>'Gagal mengubah data','errors' => $update],422);
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
        $AssetStatus = AssetStatus::find($id);

        $data_audit = [
            "ChangedDateandTime" =>date('d-m-Y H:i:s'),
            "UserID" => Auth::user()->name,
            "Action_Activity" => "Delete Asset Status",
            "Asset_ID" => $AssetStatus->id_statusasset,
            "Module_Feature" => "Master Asset Status",
        ];

        $AssetStatus = $AssetStatus->delete();

        if($AssetStatus){
            
            $audit = Audit::create($data_audit);

            return response()->json(['message'=>'Berhasil menghapus data terkait.'],200);
        }else{
            return response()->json(['message'=>'Gagal menghapus data terkait.'],422);
        }
    }
}
