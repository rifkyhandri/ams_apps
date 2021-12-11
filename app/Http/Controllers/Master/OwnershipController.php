<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Http\Controllers\Controller;
use App\Exports\OwnershipExport;
use App\Imports\OwnershipImport;
use App\Models\Ownership;
use App\Models\Audit;

use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class OwnershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('master/ownership_views/ownership');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Ownership = Ownership::get();

        return Datatables::of($Ownership)->make(true);
    }
    public function import_excel(Request $request) 
	{
		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
	    // tangkap file dan import
        $import = Excel::toArray(new OwnershipImport, request()->file('file'));
        collect(head($import))->each(function ($row) { 
        Ownership::where('id_ownership',$row['id_ownership'])->update([
            'id_ownership'=>$row['id_ownership'],
            'description'=>$row['description'],
            ]);
        });
        Excel::import(new OwnershipImport,request()->file('file'));
 
		// alihkan halaman kembali
		if($import){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('d-m-Y H:i:s');
            $data_audit = [
                "ChangedDateandTime" =>$date,
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Import Ownership",
                "Module_Feature" => "Master Ownership",
            ];

            $audit = Audit::create($data_audit);

            return redirect()->back();
        }else{
            return response()->json(['message'=>'Gagal menambah data','errors' => $import]);
        }


	}
    public function export(){
        return Excel::download(new OwnershipExport, 'Ownership.xlsx');
    }
    public function print(){
        $data = Ownership::all();
        return view('master/ownership_views/ownership_print',['ownership_print'=>$data]);
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
            "ownerdesc"              => "required|max:50",
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal menambah data','errors' => $validator->errors()],422);
        }
        $id = IdGenerator::generate(['table' => 'db_ownership','field'=>'id_ownership', 'length' => 6, 'prefix' =>'OWN','reset_on_prefix_change'=>'true']);
        $data = [
            "id_ownership"           => $id,
            "description"            => $request->ownerdesc,
        ];
        
        $insert = Ownership::create($data);

        if($insert){

            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Create Data Ownership",
                "Asset_ID" => $id,
                "Module_Feature" => "Master Ownership",
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
        $Ownership = Ownership::find($request->id);

        return response()->json($Ownership);
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
            "ownershipcode"           =>   [
                                            'required',
                                            'max:30',
                                            Rule::unique('db_ownership','id_ownership')->ignore($request->id),
                                        ],
             "ownerdesc"              => "required|max:50",
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal mengubah data','errors' => $validator->errors()],422);
        }

        $data = [
            "id_ownership"           => $request->ownershipcode,
            "description"            => $request->ownerdesc,
        ];
        $data = [
            "id_ownership"           => $request->ownershipcode,
            "description"            => $request->ownerdesc,
        ];
        $update = Ownership::where('id',$request->id)->update($data);
        
        if($update){

            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Edit Data Ownership",
                "Asset_ID" => $request->ownershipcode,
                "Module_Feature" => "Master Ownership",
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
        $Ownership = Ownership::find($id);
        
        $data_audit = [
            "ChangedDateandTime" =>date('d-m-Y H:i:s'),
            "UserID" => Auth::user()->name,
            "Action_Activity" => "Delete Data Ownership",
            "Asset_ID" => $Ownership->id_ownership,
            "Module_Feature" => "Master Ownership",
        ];
        
        $Ownership = $Ownership->delete();
        
        if($Ownership){
            
            $audit = Audit::create($data_audit);
            
            return response()->json(['message'=>'Berhasil menghapus data terkait.'],200);
        }else{
            return response()->json(['message'=>'Gagal menghapus data terkait.'],422);
        }
    }
}
