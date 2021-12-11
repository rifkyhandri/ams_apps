<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Models\Audit;
use App\Models\Account_Sub;
use App\Models\Account_Group;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class AccountSubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->id;

        $account_sub = Account_Group::find($id)->account_sub;

        return Datatables::of($account_sub)->make(true);
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
            "account_sub_name"       => "required|max:50",
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal menambah datas','errors' => $validator->errors()],422);
        }
        $idAccountSub = IdGenerator::generate(['table' => 'db_account_sub','field'=>'id_db_account_group', 'length' => 7, 'prefix' =>'ACS','reset_on_prefix_change'=>'true']);
        $data = [
            "id_db_account_group"    => $request->id_db_account_group,
            "id_account_sub"         => $idAccountSub,
            "account_sub_name"       => $request->account_sub_name,  
        ];
        
        $insert = Account_Sub::create($data);
        
        if($insert){
            
            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Create Account sub",
                "Asset_ID" => $request->id_account_sub,
                "Module_Feature" => "Master Account sub",
                "Field_Name" => $request->account_sub_name
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
        $sub = Account_Group::find($id);
        return view('master/accountchart_views/accountchart_sub',['account_group'=>$sub]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $AccountSub = Account_Sub::find($request->id);

        return response()->json($AccountSub);
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
            "id_account_sub"       =>  [
                                    'required',
                                    'max:25',
                                    Rule::unique('db_account_sub','id_account_sub')->ignore($request->id),
                                    ],
            "account_sub_name"=> "required|max:50",
           
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal mengubah data','errors' => $validator->errors()],422);
        }
       
        $data = [
            "id_db_account_group"  => $request->id_db_account_group,
            "id_account_sub"  => $request->id_account_sub,
            "account_sub_name"=> $request->account_sub_name,
        ];

        $update = Account_Sub::where('id',$request->id)->update($data);
        
        if($update){
            
            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Update Account Sub",
                "Asset_ID" => $request->id_account_sub,
                "Module_Feature" => "Master Account Sub",
                "Field_Name" => $request->account_sub_name
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
        $AccountSub = Account_Sub::find($id);

        $data_audit = [
            "ChangedDateandTime" =>date('d-m-Y H:i:s'),
            "UserID" => Auth::user()->name,
            "Action_Activity" => "Delete Account Sub",
            "Asset_ID" =>  $AccountSub->id_account_sub,
            "Module_Feature" => "Master Account Sub",
            "Field_Name" => $AccountSub->account_sub_name
        ];

        $AccountSub = $AccountSub->delete();
        

        if($AccountSub){  
            
            $audit = Audit::create($data_audit);

            return response()->json(['message'=>'Berhasil menghapus data terkait.'],200);
        }else{
            return response()->json(['message'=>'Gagal menghapus data terkait.'],422);
        }
    }
}
