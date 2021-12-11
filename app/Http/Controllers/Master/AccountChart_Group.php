<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Models\Audit;
use App\Models\Account_Group;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class AccountChart_Group extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
           return view('master/accountchart_views/accountchart_group');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Account_Group::get();
        return Datatables::of($data)->make(true);
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
            "account_group_name"       => "required|max:50",
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal menambah data','errors' => $validator->errors()],422);
        }
        $idAccountGroup = IdGenerator::generate(['table' => 'db_account_group','field'=>'id_account_group', 'length' => 7, 'prefix' =>'ACG','reset_on_prefix_change'=>'true']);
        $data = [
            "id_account_group"         => $idAccountGroup,
            "account_group_name"       => $request->account_group_name,  
        ];
        
        $insert = Account_Group::create($data);
        
        if($insert){
            
            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Create Account Group",
                "Asset_ID" => $request->id_account_group,
                "Module_Feature" => "Master Account Group",
                "Field_Name" => $request->account_group_name
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
        $AccountGroup = Account_Group::find($request->id);

        return response()->json($AccountGroup);
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
            "id_account_group"       =>  [
                                    'required',
                                    'max:25',
                                    Rule::unique('db_account_group','id_account_group')->ignore($request->id),
                                    ],
            "account_group_name"=> "required|max:50",
           
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal mengubah data','errors' => $validator->errors()],422);
        }
       
        $data = [
            "id_account_group"  => $request->id_account_group,
            "account_group_name"=> $request->account_group_name,
        ];

        $update = Account_Group::where('id',$request->id)->update($data);
        
        if($update){
            
            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Update Account Group",
                "Asset_ID" => $request->id_account_group,
                "Module_Feature" => "Master Account Group",
                "Field_Name" => $request->account_group_name
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
        $AccountGroup = Account_Group::find($id);
        $data_audit = [
            "ChangedDateandTime" =>date('d-m-Y H:i:s'),
            "UserID" => Auth::user()->name,
            "Action_Activity" => "Delete Account Group",
            "Asset_ID" =>  $AccountGroup->id_account_group,
            "Module_Feature" => "Master Account Group",
            "Field_Name" => $AccountGroup->account_group_name
        ];
        // Account_sub::where('id_db_account_group', $id)->delete();  
        $AccountGroup = $AccountGroup->delete();
        if($AccountGroup){  
            
            $audit = Audit::create($data_audit);

            return response()->json(['message'=>'Berhasil menghapus data terkait.'],200);
        }else{
            return response()->json(['message'=>'Gagal menghapus data terkait.'],422);
        }
    }
}
