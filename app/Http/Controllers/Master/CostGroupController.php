<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Http\Controllers\Controller;
use App\Exports\CostGroupExport;
use App\Imports\CostGroupImport;
use App\Models\CostGroup;
use App\Models\Audit;

use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class CostGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('master/costgroup_views/costgroup');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $CostGroup = CostGroup::get();

        return Datatables::of($CostGroup)->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function import_excel(Request $request) 
	{
		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
	    // tangkap file dan import
        $import = Excel::toArray(new CostGroupImport, request()->file('file'));
        collect(head($import))->each(function ($row) { 
        CostGroup::where('groupcode',$row['groupcode'])->update([
            'groupcode'=>$row['groupcode'],
            'groupname'=>$row['groupname'],
            'bookvalrate'=>$row['bookvalrate'],
            'life'=>$row['life'],
            'Ledger1'=>$row['ledger1'],
            'Ledger2'=>$row['ledger2'],
            'Ledger3'=>$row['ledger3'],
            'Ledger4'=>$row['ledger4'],
            'Ledger5'=>$row['ledger5'],
            'Ledger6'=>$row['ledger6'],
            'Ledger7'=>$row['ledger7'],
            'bookdeptrate'=>$row['bookdeptrate'],
            'taxdepreciation'=>$row['taxdepreciation'],
            ]);
        });
        Excel::import(new CostGroupImport,request()->file('file'));
 
		// alihkan halaman kembali
        if($import){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('d-m-Y H:i:s');
            $data_audit = [
                "ChangedDateandTime" =>$date,
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Import CostGroup",
                "Module_Feature" => "Master CostGroup",
            ];

            $audit = Audit::create($data_audit);

            return redirect()->back();
        }else{
            return response()->json(['message'=>'Gagal menambah data','errors' => $import]);
        }

	}
    public function export() 
    {
        return Excel::download(new CostGroupExport, 'CostGroup.xlsx');
    }
    public function print(){
        $data = CostGroup::all();
        return view('master/costgroup_views/costgroup_print',['costgroup_print'=>$data]);
    }
    public function store(Request $request)
    {
        //
        $validation_value = [
            "groupname"           => "required|max:50",
            "bookvalrate"         => "required|max:10",
            "life"                => "required|max:5",
            "Building"            => "required|max:5",
            "Ledger1"             => "required|max:25",
            "Ledger2"             => "required|max:25",
            "Ledger3"             => "required|max:25",
            "Ledger4"             => "required|max:25",
            "Ledger5"             => "required|max:25",
            "Ledger6"             => "required|max:25",
            "Ledger7"             => "required|max:25",
            "bookdepreciation"    => "required|max:20",
            "bookdeptrate"        => "required|gte:0",
            "taxdepreciation"     => "required|max:20",
            "taxdeprate"          => "required|gte:0",
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal menambah data','errors' => $validator->errors()],422);
        }
        $CostGroupCode = IdGenerator::generate(['table' => 'db_assetgroup','field'=>'groupcode', 'length' => 6, 'prefix' =>'ASG','reset_on_prefix_change'=>'true']);
        $data = [
            "groupcode"           => $CostGroupCode,
            "groupname"           => $request->groupname,
            "bookvalrate"         => $request->bookvalrate,
            "life"                => $request->life,
            "Building"            => $request->Building,
            "Ledger1"             => $request->Ledger1,
            "Ledger2"             => $request->Ledger2,
            "Ledger3"             => $request->Ledger3,
            "Ledger4"             => $request->Ledger4,
            "Ledger5"             => $request->Ledger5,
            "Ledger6"             => $request->Ledger6,
            "Ledger7"             => $request->Ledger7,
            "bookdepreciation"    => $request->bookdepreciation,
            "bookdeptrate"        => $request->bookdeptrate,
            "taxdepreciation"     => $request->taxdepreciation,
            "taxdeprate"          => $request->taxdeprate,
        ];
        $insert = CostGroup::create($data);
        
        if($insert){

            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Create Data Cost Group",
                "Asset_ID" => $request->groupcode,
                "Module_Feature" => "Master Cost Group",
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
        $CostGroup = CostGroup::find($request->id);

        return response()->json($CostGroup);
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
            "groupcode"           => [
                                        'required',
                                        'max:25',
                                        Rule::unique('db_assetgroup')->ignore($request->id),
                                     ],
            "groupname"           => "required|max:50",
            "bookvalrate"         => "required|max:10",
            "life"                => "required|max:5",
            "Building"            => "required|max:5",
            "Ledger1"             => "required|max:25",
            "Ledger2"             => "required|max:25",
            "Ledger3"             => "required|max:25",
            "Ledger4"             => "required|max:25",
            "Ledger5"             => "required|max:25",
            "Ledger6"             => "required|max:25",
            "Ledger7"             => "required|max:25",
            "bookdepreciation"    => "required|max:20",
            "bookdeptrate"        => "required|gte:0",
            "taxdepreciation"     => "required|max:20",
            "taxdeprate"          => "required|gte:0",
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal mengubah data','errors' => $validator->errors()],422);
        }

        $data = [
            "groupcode"           => $request->groupcode,
            "groupname"           => $request->groupname,
            "bookvalrate"         => $request->bookvalrate,
            "life"                => $request->life,
            "Building"            => $request->Building,
            "Ledger1"             => $request->Ledger1,
            "Ledger2"             => $request->Ledger2,
            "Ledger3"             => $request->Ledger3,
            "Ledger4"             => $request->Ledger4,
            "Ledger5"             => $request->Ledger5,
            "Ledger6"             => $request->Ledger6,
            "Ledger7"             => $request->Ledger7,
            "bookdepreciation"    => $request->bookdepreciation,
            "bookdeptrate"        => $request->bookdeptrate,
            "taxdepreciation"     => $request->taxdepreciation,
            "taxdeprate"          => $request->taxdeprate,
        ];
        
        $update = CostGroup::where('id',$request->id)->update($data);
        
        if($update){
            
            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Edit Data Cost Group",
                "Asset_ID" => $request->groupcode,
                "Module_Feature" => "Master Cost Group",
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
        $CostGroup = CostGroup::find($id);

        $data_audit = [
            "ChangedDateandTime" =>date('d-m-Y H:i:s'),
            "UserID" => Auth::user()->name,
            "Action_Activity" => "Delete Data Cost Group",
            "Asset_ID" => $CostGroup->groupcode,
            "Module_Feature" => "Master Cost Group",
        ];
        
        $CostGroup = $CostGroup->delete();
        
        if($CostGroup){
            
            $audit = Audit::create($data_audit);
            
            return response()->json(['message'=>'Berhasil menghapus data terkait.'],200);
        }else{
            return response()->json(['message'=>'Gagal menghapus data terkait.'],422);
        }
    }
}
