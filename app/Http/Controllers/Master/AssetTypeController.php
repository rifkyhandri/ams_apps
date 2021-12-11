<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Exports\AssetTypeExport;
use App\Imports\AssetTypeImport;
use App\Models\AssetType;
use App\Models\Audit;
use App\Http\Controllers\Controller;

use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class AssetTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('master/assettype_views/assettype');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $AssetType = AssetType::get();

        return Datatables::of($AssetType)->make(true);
    }
    public function import_excel(Request $request) 
	{
		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
	    // tangkap file dan import
        $import = Excel::toArray(new AssetTypeImport, request()->file('file'));
        collect(head($import))->each(function ($row) { 
        AssetType::where('id_typeasset',$row['id_type_asset'])->update([
            'id_typeasset'=>$row['id_type_asset'],
            'description'=>$row['description'],
            ]);
        });
        Excel::import(new AssetTypeImport,request()->file('file'));
 
		// alihkan halaman kembali
        if($import){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('d-m-Y H:i:s');
            $data_audit = [
                "ChangedDateandTime" =>$date,
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Import Asset Type",
                "Module_Feature" => "Master Asset Type",
            ];

            $audit = Audit::create($data_audit);

            return redirect()->back();
        }else{
            return response()->json(['message'=>'Gagal menambah data','errors' => $import]);
        }

	}
    public function export(){
        return Excel::download(new AssetTypeExport, 'AssetType.xlsx');
    }
    public function print(){
        $data = AssetType::all();
        return view('master/assettype_views/assettype_print',['assettype_print'=>$data]);
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
            "typecode"          => "required|unique:db_typeasset,id_typeasset|max:30",
            "typedesc"           => "required|max:50",
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal menambah data','errors' => $validator->errors()],422);
        }

        $data = [
            "id_typeasset"           => $request->typecode,
            "description"            => $request->typedesc,
        ];
        
        $insert = AssetType::create($data);
        
        if($insert){
            
            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Create Asset Type",
                "Asset_ID" => $request->typecode,
                "Module_Feature" => "Master Asset Type",
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
        $AssetType = AssetType::find($request->id);

        return response()->json($AssetType);
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
            "typecode"           =>   [
                                            'required',
                                            'max:30',
                                            Rule::unique('db_typeasset','id_typeasset')->ignore($request->id),
                                        ],
             "typedesc"           => "required|max:75",
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal mengubah data','errors' => $validator->errors()],422);
        }

        $data = [
            "id_typeasset"           => $request->typecode,
            "description"           => $request->typedesc,
        ];
       
        $update = AssetType::where('id',$request->id)->update($data);

        if($update){
            
            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Edit Asset Type",
                "Asset_ID" => $request->typecode,
                "Module_Feature" => "Master Asset Type",
        
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
        $AssetType = AssetType::find($id);
        
        $data_audit = [
            "ChangedDateandTime" =>date('d-m-Y H:i:s'),
            "UserID" => Auth::user()->name,
            "Action_Activity" => "Delete Asset Type",
            "Asset_ID" => $AssetType->id_typeasset,
            "Module_Feature" => "Master Asset Type",
    
        ];

        $AssetType = $AssetType->delete();
        
        if($AssetType){

            $audit = Audit::create($data_audit);
            
            return response()->json(['message'=>'Berhasil menghapus data terkait.'],200);
        }else{
            return response()->json(['message'=>'Gagal menghapus data terkait.'],422);
        }
    }
}
