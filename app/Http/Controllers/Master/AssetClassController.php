<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Exports\AssetClassExport;
use App\Imports\AssetClassImport;
use App\Models\AssetClass;
use App\Models\Audit;
use App\Http\Controllers\Controller;

use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class AssetClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('master/assetclass_views/assetclass');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $AssetClass = AssetClass::get();

        return Datatables::of($AssetClass)->make(true);
    }
    public function import_excel(Request $request) 
	{
		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
	    // tangkap file dan import
        $import = Excel::toArray(new AssetClassImport, request()->file('file'));
        collect(head($import))->each(function ($row) { 
            AssetClass::where('classcode',$row['class_code'])->update([
                'classcode'=>$row['class_code'],
                'classdesc'=>$row['class_description'],
            ]);
        });

        Excel::import(new AssetClassImport,request()->file('file'));
        if($import){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('d-m-Y H:i:s');
            $data_audit = [
                "ChangedDateandTime" => $date,
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Import Asset Class",
                "Module_Feature" => "Master Asset Class",
                
            ];
            $audit = Audit::create($data_audit);
            return redirect()->back();
        }else{
            return response()->json(['message'=>'Gagal menambah data','errors' => $import]);
        }

	}
    public function export(){
        return Excel::download(new AssetClassExport, 'assetClass.xlsx');
    }
    public function print(){
        $data = AssetClass::all();
        return view('master/assetclass_views/assetclass_print',['assetclass_print'=>$data]);
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
            "classdesc"           => "required|max:75",
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal menambah data','errors' => $validator->errors()],422);
        }
        $id_assetclass = IdGenerator::generate(['table' => 'db_assetclass','field'=>'classcode', 'length' => 7, 'prefix' =>'ACT','reset_on_prefix_change'=>'true']);
        $data = [
            "classcode"           => $id_assetclass,
            "classdesc"           => $request->classdesc,
        ];
      
        $insert = AssetClass::create($data);

        if($insert){
            
            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Create Asset Class",
                "Asset_ID" => $id_assetclass,
                "Module_Feature" => "Master Asset Class",
                "Field_Name" => $request->classdesc
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
        $AssetClass = AssetClass::find($request->id);

        return response()->json($AssetClass);
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
            "aclasscode"           =>   [
                                            'required',
                                            'max:15',
                                            Rule::unique('db_assetclass','classcode')->ignore($request->id),
                                        ],
             "classdesc"           => "required|max:75",
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal mengubah data','errors' => $validator->errors()],422);
        }

        $data = [
            "classcode"           => $request->aclasscode,
            "classdesc"           => $request->classdesc,
        ];
       
        $update = AssetClass::where('id',$request->id)->update($data);

        if($update){
            
            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Update Asset Class",
                "Asset_ID" => $request->aclasscode,
                "Module_Feature" => "Master Asset Class",
                "Field_Name" => $request->classdesc
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
        $AssetClass = AssetClass::find($id);

        $data_audit = [
            "ChangedDateandTime" =>date('d-m-Y H:i:s'),
            "UserID" => Auth::user()->name,
            "Action_Activity" => "Delete Asset Class",
            "Asset_ID" => $AssetClass->classcode,
            "Module_Feature" => "Master Asset Class",
            "Field_Name" => $AssetClass->classdesc
         ];

        $AssetClass = $AssetClass->delete();

        if($AssetClass){   
            $audit = Audit::create($data_audit);
            return response()->json(['message'=>'Berhasil menghapus data terkait.'],200);
        }else{
            return response()->json(['message'=>'Gagal menghapus data terkait.'],422);
        }
    }
}
