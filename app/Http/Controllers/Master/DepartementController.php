<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Http\Controllers\Controller;
use App\Exports\DepartementExport;
use App\Imports\DepartementImport;
use App\Models\Audit;
use App\Models\Departement;

use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('master/departement_views/departement');
    }
    public function import_excel(Request $request) 
	{
		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
	    // tangkap file dan import
        $import = Excel::toArray(new DepartementImport, request()->file('file'));
        collect(head($import))->each(function ($row) { 
        Departement::where('departementcode',$row['departement_code'])->update([
            'departementcode'=>$row['departement_code'],
            'departementdesc'=>$row['departement_desc'],
            ]);
        });
        Excel::import(new DepartementImport,request()->file('file'));
 
		// alihkan halaman kembali
		if($import){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('d-m-Y H:i:s');
            $data_audit = [
                "ChangedDateandTime" =>$date,
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Import Departement",
                "Module_Feature" => "Master Departement",
            ];

            $audit = Audit::create($data_audit);

            return redirect()->back();
        }else{
            return response()->json(['message'=>'Gagal menambah data','errors' => $import]);
        }

	}
    public function export() 
    {
        return Excel::download(new DepartementExport, 'Departement.xlsx');
    }
    public function print(){
        $data = Departement::all();
        return view('master/departement_views/departement_print',['departement_print'=>$data]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $Departement = Departement::get();

        return Datatables::of($Departement)->make(true);
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
        $validation_value = [
            'departementcode'           => 'required|unique:db_departement|max:15',
            'departementdesc'           => 'required|max:75',
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal menambah data','errors' => $validator->errors()],422);
        }

        
        $data = [
            'departementcode'           => $request->departementcode,
            'departementdesc'           => $request->departementdesc,
        ];
        $insert = Departement::create($data);
        
        if($insert){
            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Create Data Departement",
                "Asset_ID" => $request->departementcode,
                "Module_Feature" => "Master Departement",
            ];

            $audit = Audit::create($data_audit);
            
            return response()->json(['message'=>'Berhasil menambah data!'],200);
        }else{
            return response()->json(['message'=>'Gagal menambah data','errors' => $insert],422);
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
        //
        $departement = Departement::find($request->id);

        return response()->json($departement);
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
        $validation_value = [
            'departementcode'           => [
                                         'required',
                                         'max:15',
                                         Rule::unique('db_departement')->ignore($request->id),
                                        ],
            'departementdesc'           => 'required|max:75',
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal mengubah data','errors' => $validator->errors()],422);
        }

        $data = [
            'departementcode'           => $request->departementcode,
            'departementdesc'           => $request->departementdesc,
        ];
        $update = Departement::where('id',$request->id)->update($data);
        
        if($update){
            
            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Edit Data Departement",
                "Asset_ID" => $request->departementcode,
                "Module_Feature" => "Master Departement",
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
        //
        $Departement = Departement::find($id);
        
        $data_audit = [
            "ChangedDateandTime" =>date('d-m-Y H:i:s'),
            "UserID" => Auth::user()->name,
            "Action_Activity" => "Delete Data Departement",
            "Asset_ID" => $Departement->departementcode,
            "Module_Feature" => "Master Departement",
        ];
        
        $Departement = $Departement->delete();
        
        if($Departement){

            $audit = Audit::create($data_audit);
            
            return response()->json(['message'=>'Berhasil menghapus data terkait.'],200);
        }else{
            return response()->json(['message'=>'Gagal menghapus data terkait.'],422);
        }
    }
}
