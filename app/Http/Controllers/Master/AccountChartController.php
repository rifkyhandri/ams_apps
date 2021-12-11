<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Http\Controllers\Controller;
use App\Exports\AccountChartExport;
use App\Imports\AccountChartImport;
use App\Models\Audit;
use App\Models\AccountChart;
use App\Models\Account_Group;
use App\Models\Account_Sub;

use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class AccountChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $AccountGroup = Account_Group::get();
        $AccountSub = Account_Sub::get();
        return view('master/accountchart_views/accountchart',['account_group'=>$AccountGroup,'account_sub'=>$AccountSub]);
    }

    public function accountGroup_json(){
        $AccountGroup = Account_Group::with('account_sub')->get();
        return response()->json($AccountGroup);
    }
    public function export(){
        return Excel::download(new AccountChartExport, 'accountChart.xlsx');
    }
    public function import_excel(Request $request) 
	{
		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
	 
        $import = Excel::toArray(new AccountChartImport, request()->file('file'));
            collect(head($import))->each(function ($row) { 
                // DB::table('db_account')->where('accountno', $row['account_no'])->updateOrInsert(Arr::except($row, ['id'])); 
            AccountChart::where('accountno',$row['account_no'])->update([
                'accountno'=>$row['account_no'],
                'accountname'=>$row['account_name'],
                'accountshortname'=>$row['account_short_name'],
                'accountgroup'=>$row['account_group'],
                'oldaccount'=>$row['old_account'],
                'subgroup'=>$row['subs_group'],
                'level'=>$row['level'],
                'status'=>$row['status']
            ]);
        });
       Excel::import(new AccountChartImport,request()->file('file'));
        if($import){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('d-m-Y H:i:s');
            $data_audit = [
                "ChangedDateandTime" => $date,
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Create Account Chart",
                "Module_Feature" => "Master Account Chart",
                // "Field_Name" => $import->accountname
            ];

            $audit = Audit::create($data_audit);

            return redirect()->back();
        }else{
            return response()->json(['message'=>'Gagal menambah data','errors' => $import]);
        }
		// return redirect('/account');

	}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $AccountChart = AccountChart::get();
        return Datatables::of($AccountChart)->make(true);
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
            "accountno"         => "required|unique:db_account,accountno|max:25",
            "accountname"       => "required|max:50",
            "accountshortname"  => "required|max:25",
            "accountgroup"      => "required|max:25",
            "oldaccount"        => "required|max:25",
            "subgroup"          => "required|max:25",
            "level"             => "required|max:5",
            "statusaccount"     => "required|max:15",
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal menambah data','errors' => $validator->errors()],422);
        }
       
        $data = [
            "accountno"         => $request->accountno,
            "accountname"       => $request->accountname,
            "accountshortname"  => $request->accountshortname,
            "accountgroup"      => $request->accountgroup,   
            "oldaccount"        => $request->oldaccount,     
            "subgroup"          => $request->subgroup,       
            "level"             => $request->level,         
            "status"            => $request->statusaccount,    
        ];
        
        $insert = AccountChart::create($data);
        
        if($insert){
            
            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Create Account Chart",
                "Asset_ID" => $request->accountno,
                "Module_Feature" => "Master Account Chart",
                "Field_Name" => $request->accountname
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
        $AccountChart = AccountChart::find($request->id);

        return response()->json($AccountChart);
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
            "accountno"         =>  [
                                    'required',
                                    'max:25',
                                    Rule::unique('db_account','accountno')->ignore($request->id),
                                    ],
            "accountname"       => "required|max:50",
            "accountshortname"  => "required|max:25",
            "accountgroup"      => "required|max:25",
            "oldaccount"        => "required|max:25",
            "subgroup"          => "required|max:25",
            "level"             => "required|max:5",
            "statusaccount"     => "required|max:15",
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal mengubah data','errors' => $validator->errors()],422);
        }
       
        $data = [
            "accountno"         => $request->accountno,
            "accountname"       => $request->accountname,
            "accountshortname"  => $request->accountshortname,
            "accountgroup"      => $request->accountgroup,   
            "oldaccount"        => $request->oldaccount,     
            "subgroup"          => $request->subgroup,       
            "level"             => $request->level,         
            "status"            => $request->statusaccount,    
        ];

        $update = AccountChart::where('id',$request->id)->update($data);
        
        if($update){
            
            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Update Account Chart",
                "Asset_ID" => $request->accountno,
                "Module_Feature" => "Master Account Chart",
                "Field_Name" => $request->accountname
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

        $AccountChart = AccountChart::find($id);

        $data_audit = [
            "ChangedDateandTime" =>date('d-m-Y H:i:s'),
            "UserID" => Auth::user()->name,
            "Action_Activity" => "Delete Account Chart",
            "Asset_ID" =>  $AccountChart->accountno,
            "Module_Feature" => "Master Account Chart",
            "Field_Name" => $AccountChart->accountname
        ];

        $AccountChart = $AccountChart->delete();

        if($AccountChart){  
            
            $audit = Audit::create($data_audit);

            return response()->json(['message'=>'Berhasil menghapus data terkait.'],200);
        }else{
            return response()->json(['message'=>'Gagal menghapus data terkait.'],422);
        }
    }
    public function print(){
        $data = AccountChart::all();
        return view('master/accountchart_views/accountchart_print',['print_accountchart'=>$data]);
    }
  
}
