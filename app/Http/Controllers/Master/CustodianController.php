<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Http\Controllers\Controller;
use App\Exports\CustodianExport;
use App\Imports\CustodianImport;
use App\Models\Audit;
use App\Models\Custodian;

use Maatwebsite\Excel\Facades\Excel;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Yajra\Datatables\Datatables;

class CustodianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        return view('master/custodian_views/custodian');
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
        $import = Excel::toArray(new CustodianImport, request()->file('file'));
        collect(head($import))->each(function ($row) { 
        Custodian::where('custodiancode',$row['custodiancode'])->update([
            'custodiancode'=>$row['custodiancode'],
            'custodianname'=>$row['custodianname'],
            'contact'=>$row['contact'],
            'address'=>$row['address'],
            'OpeningDate'=>$row['openingdate'],
            'phone'=>$row['phone'],
            'city'=>$row['city'],
            'postal'=>$row['postal'],
            'fax'=>$row['fax'],
            'telex'=>$row['telex'],
            'email'=>$row['email'],
            'usertype'=>$row['usertype'],
            'company'=>$row['company'],
            'status'=>$row['status'],
            ]);
        });
        Excel::import(new CustodianImport,request()->file('file'));
 
		if($import){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('d-m-Y H:i:s');
            $data_audit = [
                "ChangedDateandTime" =>$date,
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Import Custodian",
                "Module_Feature" => "Master Custodian",
            ];

            $audit = Audit::create($data_audit);

            return redirect()->back();
        }else{
            return response()->json(['message'=>'Gagal menambah data','errors' => $import]);
        }

	}
    public function export() 
    {
        return Excel::download(new CustodianExport, 'Custodian.xlsx');
    }
    public function create()
    {
        //
        $Custodian = Custodian::get();

        return Datatables::of($Custodian)->make(true);
    }

    public function print(){
        $data = Custodian::all();
        return view('master/custodian_views/custodian_print',['custodian_print'=>$data]);
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
            "custodianname"       => "required|max:100",
            "contact"             => "required|max:30",
            "address"             => "required|max:255",
            "OpeningDate"         => "required|max:15",
            "phone"               => "required|max:30",
            "city"                => "required|max:25",
            "cpostal"              => "required|max:10",
            "cfax"                 => "required|max:15",
            "telex"               => "required|max:15",
            "company"             => "required|max:30",
            "email"               => "required|max:30",
            "usertype"            => "required|max:30",
            "status"              => "required|max:10",
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal menambah data','errors' => $validator->errors()],422);
        }
        $id = IdGenerator::generate(['table' => 'db_custodian','field'=>'custodiancode', 'length' => 6, 'prefix' =>'CST']);
        $data = [
            "custodiancode"       => $id,
            "custodianname"       => $request->custodianname,
            "contact"             => $request->contact,
            "address"             => $request->address,
            "OpeningDate"         => $request->OpeningDate,
            "phone"               => $request->phone,
            "city"                => $request->city,
            "postal"              => $request->cpostal,
            "fax"                 => $request->cfax,
            "telex"               => $request->telex,
            "company"             => $request->company,
            "email"               => $request->email,
            "usertype"            => $request->usertype,
            "status"              => $request->status,
        ];

        $insert = Custodian::create($data);
        
        if($insert){
            
            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Create Data Custodian",
                "Asset_ID" => $id,
                "Module_Feature" => "Master Custodian",
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
        $Custodian = Custodian::find($request->id);

        return response()->json($Custodian);
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
            "custodiancode"       => [
                                        'required',
                                        'max:100',
                                        Rule::unique('db_custodian')->ignore($request->id),
                                    ],
            "custodianname"       => "required|max:100",
            "contact"             => "required|max:30",
            "address"             => "required|max:255",
            "OpeningDate"         => "required|max:15",
            "phone"               => "required|max:30",
            "city"                => "required|max:25",
            "cpostal"              => "required|max:10",
            "cfax"                 => "required|max:15",
            "telex"               => "required|max:15",
            "company"             => "required|max:30",
            "email"               => "required|max:30",
            "usertype"            => "required|max:30",
            "status"              => "required|max:10",
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal menambah data','errors' => $validator->errors()],422);
        }

        $data = [
            "custodiancode"       => $request->custodiancode,
            "custodianname"       => $request->custodianname,
            "contact"             => $request->contact,
            "address"             => $request->address,
            "OpeningDate"         => $request->OpeningDate,
            "phone"               => $request->phone,
            "city"                => $request->city,
            "postal"              => $request->cpostal,
            "fax"                 => $request->cfax,
            "telex"               => $request->telex,
            "company"             => $request->company,
            "email"               => $request->email,
            "usertype"            => $request->usertype,
            "status"              => $request->status,
        ];
        $update = Custodian::where('id',$request->id)->update($data);
        
        if($update){

            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Edit Data Custodian",
                "Asset_ID" => $request->custodiancode,
                "Module_Feature" => "Master Custodian",
            ];

            $audit = Audit::create($data_audit);
            
            return response()->json(['message'=>'Berhasil menambah data!'],200);
        }else{
            return response()->json(['message'=>'Gagal menambah data','errors' => $insert],422);
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
        $Custodian = Custodian::find($id);

        $data_audit = [
            "ChangedDateandTime" =>date('d-m-Y H:i:s'),
            "UserID" => Auth::user()->name,
            "Action_Activity" => "Delete Data Custodian",
            "Asset_ID" => $Custodian->custodiancode,
            "Module_Feature" => "Master Custodian",
        ];
        
        $Custodian = $Custodian->delete();
        
        if($Custodian){

            $audit = Audit::create($data_audit);
            
            return response()->json(['message'=>'Berhasil menghapus data terkait.'],200);
        }else{
            return response()->json(['message'=>'Gagal menghapus data terkait.'],422);
        }
    }
}
