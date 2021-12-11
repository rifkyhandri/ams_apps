<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Http\Controllers\Controller;
use App\Imports\VendorImport;
use App\Exports\VendorExport;
use App\Models\Audit;
use App\Models\Vendor;

use Maatwebsite\Excel\Facades\Excel;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Yajra\Datatables\Datatables;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('master/vendor_views/vendor');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function export() 
    {
        return Excel::download(new VendorExport, 'vendor.xlsx');
    }
    public function print(){
        $vendor = Vendor::all();
        return view('master/vendor_views/vendor_print',['vendor'=>$vendor]);
    }
    public function import_excel(Request $request) 
	{
		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
	    // tangkap file dan import
        $import = Excel::toArray(new VendorImport, request()->file('file'));
        collect(head($import))->each(function ($row) { 
        Vendor::where('vendorcode',$row['vendor_code'])->update([
            'vendorcode' => $row['vendor_code'],
            'vendorname' => $row['vendor_name'],
            'account' => $row['account'],
            'address' =>$row['address'],
            'city' =>$row['city'],
            'postal' =>$row['postal'],
            'phone'=>$row['phone'],
            'fax'=>$row['fax'],
            'status'=>$row['status'],
            'pic'=>$row['pic'],
            'pic_phone'=>$row['pic_phone'],
            'pic_email'=>$row['pic_email'],
            ]);
        });
        Excel::import(new VendorImport,request()->file('file'));
 
		// alihkan halaman kembali
		if($import){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('d-m-Y H:i:s');
            $data_audit = [
                "ChangedDateandTime" =>$date,
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Import Vendor",
                "Module_Feature" => "Master Vendor",
            ];

            $audit = Audit::create($data_audit);

            return redirect()->back();
        }else{
            return response()->json(['message'=>'Gagal menambah data','errors' => $import]);
        }


	}
 /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $Vendor = Vendor::get();
        return Datatables::of($Vendor)->make(true);
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
            "vendorname" => "required|max:100",
            "account" => "required|max:15",
            "vstatus" => "required|max:10",
            "vfax" => "required|max:15",
            "vphone" => "required|max:30",
            "vcity" => "required|max:25",
            "vpostal" => "required|max:10",
            "pic" => "required|max:30",
            "pic_phone" => "required|max:30|unique:db_vendor",
            "pic_email" => "required|max:30|unique:db_vendor",
            "vaddress" => "required|max:255",
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal menambah data','errors' => $validator->errors()],422);
        }
        // 'ChangedDateandTime','UserID','Action_Activity','Asset_ID','Module_Feature','Field_Name','OldValue_Remark','NewValue_Remark','Other1
        $id_vendor = IdGenerator::generate(['table' => 'db_vendor','field'=>'vendorcode', 'length' => 6, 'prefix' =>'VEN']);
        
        $data = [
            "vendorcode" => $id_vendor,
            "account" => $request->account,
            "vendorname" => $request->vendorname,
            "fax" => $request->vfax,
            "phone" => $request->vphone,
            "city" => $request->vcity,
            "postal" => $request->vpostal,
            "address" => $request->vaddress,
            "status" => $request->vstatus,
            "pic" => $request->pic,
            "pic_phone" => $request->pic_phone,
            "pic_email" => $request->pic_email,
        ];

        $insert = Vendor::create($data);
        
        if($insert){
            
            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Create Data Vendor",
                "Asset_ID" => $request->vendorcode,
                "Module_Feature" => "Master Vendor",
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
    
        $Vendor = Vendor::find($request->id);
        return response()->json($Vendor);
      
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
            "vendorcode" => [
                                'required',
                                'max:100',
                                Rule::unique('db_vendor')->ignore($request->id),
                            ],
            "vendorname" => "required|max:100",
            "account"    => "required|max:15",
            "vstatus"    => "required|max:10",
            "vfax"       => "required|max:15",
            "vphone"     => "required|max:30",
            "vcity"      => "required|max:25",
            "vpostal"    => "required|max:10",
            "pic"        => "required|max:30",
            "pic_phone"  => [
                                'required',
                                'max:30',
                                Rule::unique('db_vendor')->ignore($request->id),
                            ],
            "pic_email"  => [
                                'required',
                                'max:30',
                                Rule::unique('db_vendor')->ignore($request->id),
                            ],
            "vaddress"   => "required|max:255",
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal menambah data','errors' => $validator->errors()],422);
        }

        $data = [
            "vendorcode" => $request->vendorcode,
            "account" => $request->account,
            "vendorname" => $request->vendorname,
            "fax" => $request->vfax,
            "phone" => $request->vphone,
            "city" => $request->vcity,
            "postal" => $request->vpostal,
            "address" => $request->vaddress,
            "status" => $request->vstatus,
            "pic" => $request->pic,
            "pic_phone" => $request->pic_phone,
            "pic_email" => $request->pic_email,
        ];

        $update = Vendor::where('id',$request->id)->update($data);
        
        if($update){
            
            $data_audit = [
                    "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                    "UserID" => Auth::user()->name,
                    "Action_Activity" => "Edit Data Vendor",
                    "Asset_ID" => $request->vendorcode,
                    "Module_Feature" => "Master Vendor",
            ];
            
            $audit = Audit::create($data_audit);
            
            return response()->json(['message'=>'Berhasil mengubah data!'],200);
        }else{
            return response()->json(['message'=>'Gagal mengubah data','errors' => $insert]);
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
       
        $Vendor = Vendor::find($id);

        $data_audit = [
            "ChangedDateandTime" =>date('d-m-Y H:i:s'),
            "UserID" => Auth::user()->name,
            "Action_Activity" => "Delete Data Vendor",
            "Asset_ID" => $Vendor->vendorcode,
            "Module_Feature" => "Master Vendor",
         ];
         
         $Vendor = $Vendor->delete();
         
         if($Vendor){

            $audit = Audit::create($data_audit);
            
            return response()->json(['message'=>'Berhasil menghapus data terkait.'],200);
        }else{
            return response()->json(['message'=>'Gagal menghapus data terkait.'],422);
        }
    }
}
