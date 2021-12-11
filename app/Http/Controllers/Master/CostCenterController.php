<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Http\Controllers\Controller;
use App\Exports\CostCenterExport;
use App\Imports\CostCenterImport;
use App\Models\CostCenter;
use App\Models\Audit;

use Yajra\Datatables\Datatables;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Maatwebsite\Excel\Facades\Excel;

class CostCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('master/costcenter_views/costcenter');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function import_excel(Request $request) 
	{
		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
	    // tangkap file dan import
		$import = Excel::toArray(new CostCenterImport, request()->file('file'));
        collect(head($import))->each(function ($row) { 
        CostCenter::where('costcentercode',$row['cost_center_code'])->update([
            'costcentercode'=>$row['cost_center_code'],
            'costcenterdesc'=>$row['description'],
            'coa'=>$row['coa'],
            ]);
        });
        Excel::import(new CostCenterImport,request()->file('file'));
 
		// alihkan halaman kembali
        if($import){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('d-m-Y H:i:s');
            $data_audit = [
                "ChangedDateandTime" =>$date,
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Import CostCenter",
                "Module_Feature" => "Master CostCenter",
            ];

            $audit = Audit::create($data_audit);

            return redirect()->back();
        }else{
            return response()->json(['message'=>'Gagal menambah data','errors' => $import]);
        }

	}
    public function export() 
    {
        return Excel::download(new CostCenterExport, 'CostCenter.xlsx');
    }
    public function create()
    {
        $CostCenter = CostCenter::get();

        return Datatables::of($CostCenter)->make(true);
    }
    public function print(){
        
        $data = CostCenter::all();
        return view('master/costcenter_views/costcenter_print',['costcenter_print'=>$data]);
        
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
            "costcenterdesc"           => "required|max:50",
            "coa"                      => "required|max:25",
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal menambah data','errors' => $validator->errors()],422);
        }
        $CostCenterCode = IdGenerator::generate(['table' => 'db_costcenter','field'=>'costcentercode', 'length' => 6, 'prefix' =>'COC','reset_on_prefix_change'=>'true']);
        $data = [
            "costcentercode"           => $CostCenterCode,
            "costcenterdesc"           => $request->costcenterdesc,
            "coa"                      => $request->coa,
        ];
        $insert = CostCenter::create($data);
        
        if($insert){
            
            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Create Data Cost Center",
                "Asset_ID" => $request->costcentercode,
                "Module_Feature" => "Master Cost Center",
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
        //
       $CostCenter = CostCenter::find($request->id);

        return response()->json($CostCenter);
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
            "costcentercode"           =>   [
                                                'required',
                                                'max:25',
                                                Rule::unique('db_costcenter')->ignore($request->id),
                                            ],
             "costcenterdesc"           => "required|max:50",
             "coa"                      => "required|max:25",
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal mengubah data','errors' => $validator->errors()],422);
        }

        $data = [
            "costcentercode"           => $request->costcentercode,
            "costcenterdesc"           => $request->costcenterdesc,
            "coa"                      => $request->coa,
        ];
        $update = CostCenter::where('id',$request->id)->update($data);
        
        if($update){
            
            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Edit Data Cost Center",
                "Asset_ID" => $request->costcentercode,
                "Module_Feature" => "Master Cost Center",
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
        $CostCenter = CostCenter::find($id);

        $data_audit = [
            "ChangedDateandTime" =>date('d-m-Y H:i:s'),
            "UserID" => Auth::user()->name,
            "Action_Activity" => "Delete Data Cost Center",
            "Asset_ID" => $CostCenter->costcentercode,
            "Module_Feature" => "Master Cost Center",
        ];

        
        $CostCenter = $CostCenter->delete();
        
        if($CostCenter){

            $audit = Audit::create($data_audit);
            
            return response()->json(['message'=>'Berhasil menghapus data terkait.'],200);
        }else{
            return response()->json(['message'=>'Gagal menghapus data terkait.'],422);
        }
    }
}
