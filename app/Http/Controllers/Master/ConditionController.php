<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Http\Controllers\Controller;
use App\Exports\ConditionExport;
use App\Imports\ConditionImport;
use App\Models\Condition;
use App\Models\Audit;

use Yajra\Datatables\Datatables;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Maatwebsite\Excel\Facades\Excel;

class ConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('master/condition_views/condition');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $Condition = Condition::get();

        return Datatables::of($Condition)->make(true);
    }
    public function import_excel(Request $request) 
	{
		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
	    // tangkap file dan import
        $import = Excel::toArray(new ConditionImport, request()->file('file'));
        collect(head($import))->each(function ($row) { 
        Condition::where('conditioncode',$row['condition_code'])->update([
            'conditioncode'=>$row['condition_code'],
            'conditiondesc'=>$row['description'],
            ]);
        });
        Excel::import(new ConditionImport,request()->file('file'));
 
        if($import){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('d-m-Y H:i:s');
            $data_audit = [
                "ChangedDateandTime" =>$date,
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Import Condition",
                "Module_Feature" => "Master Condition",
            ];

            $audit = Audit::create($data_audit);

            return redirect()->back();
        }

	}
    public function export(){
        return Excel::download(new ConditionExport, 'Condition.xlsx');
    }
    public function print(){
        $data = Condition::all();
        return view('master/condition_views/condition_print',['condition_print'=>$data]);
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
            "conditiondesc"           => "required|max:255",
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal menambah data','errors' => $validator->errors()],422);
        }
        $id = IdGenerator::generate(['table' => 'db_condition','field'=>'conditioncode', 'length' => 6, 'prefix' =>'CDT','reset_on_prefix_change'=>'true']);
        $data = [
            "conditioncode"           => $id,
            "conditiondesc"           => $request->conditiondesc,
        ];
        $insert = Condition::create($data);
        
        if($insert){
            
            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Create Condition Master",
               "Asset_ID" => $id,
                "Module_Feature" => "Master Condition",
        
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
        $Condition = Condition::find($request->id);

        return response()->json($Condition);
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
            "conditioncode"           =>   [
                                                'required',
                                                'max:25',
                                                Rule::unique('db_condition')->ignore($request->id),
                                            ],
             "conditiondesc"           => "required|max:255",
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal mengubah data','errors' => $validator->errors()],422);
        }

        $data = [
            "conditioncode"           => $request->conditioncode,
            "conditiondesc"           => $request->conditiondesc,
        ];
        $update = Condition::where('id',$request->id)->update($data);
        
        if($update){
            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Edit Condition Master",
                "Asset_ID" => $request->conditioncode,
                "Module_Feature" => "Master Condition",
        
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
        $Condition = Condition::find($id);
        
        $data_audit = [
            "ChangedDateandTime" =>date('d-m-Y H:i:s'),
            "UserID" => Auth::user()->name,
            "Action_Activity" => "Delete Condition Master",
            "Asset_ID" => $Condition->conditioncode,
            "Module_Feature" => "Master Condition",
         ];

         
         $Condition = $Condition->delete();
         
         if($Condition){

            $audit = Audit::create($data_audit);
            
            return response()->json(['message'=>'Berhasil menghapus data terkait.'],200);
        }else{
            return response()->json(['message'=>'Gagal menghapus data terkait.'],422);
        }
    }
}
