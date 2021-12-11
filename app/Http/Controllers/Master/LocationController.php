<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Imports\LocationImport;
use App\Exports\LocationExport;
use App\Models\Audit;
use App\Models\Location;
use App\Models\Location_sub;
use App\Models\Location_sm;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('master/location_views/location');
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $location = Location::get();

        return Datatables::of($location)->make(true);
    }
    
    public function print(){
        // print map location 
        // location_view/location_print
        $location = Location::all();
        return view('master/location_views/location_print',['location'=>$location]);
    }
    public function printlist(){
        // print map location 
        // location_view/location_print
        $location = Location::all();
            $location_sub = Location_sub::all();
                $location_sm = Location_sm::all();
        return view('master/location_views/location_print_list',['location'=>$location,'location_sub'=>$location_sub,'location_sm'=>$location_sm]);
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
		$import = Excel::toArray(new LocationImport, request()->file('file'));
        collect(head($import))->each(function ($row) { 
        Location::where('locationcode',$row['location_code'])->update([
            'locationcode'=>$row['location_code'],
            'locationname'=>$row['country'],
            'country'=>$row['country'],
            ]);
        });
        Excel::import(new LocationImport,request()->file('file'));
		// alihkan halaman kembali
		if($import){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('d-m-Y H:i:s');
            $data_audit = [
                "ChangedDateandTime" =>$date,
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Import Location",
                "Module_Feature" => "Master Location",
            ];

            $audit = Audit::create($data_audit);

            return redirect()->back();
        }else{
            return response()->json(['message'=>'Gagal menambah data','errors' => $import]);
        }

	}
    public function export(){
        return Excel::download(new LocationExport, 'location.xlsx');
    }
    public function store(Request $request)
    {
        //
        $validation_value = [
            // 'locationcode'           => 'required|unique:db_location|max:50',
            'locationname'           => 'required|max:50',
            'country'                   => 'required|max:25',
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal menambah data','errors' => $validator->errors()],422);
        }

        $id_location = IdGenerator::generate(['table' => 'db_location','field'=>'locationcode', 'length' => 7, 'prefix' =>'LCT','reset_on_prefix_change'=>'true']);

        $data = [
            'locationcode'           => $id_location,
            'locationname'           => $request->locationname,
            'country'                   => $request->country,
        
        ];
        
        $insert = Location::create($data);
        
        $data_audit = [
            "ChangedDateandTime" =>date('d-m-Y H:i:s'),
            "UserID" => Auth::user()->name,
            "Action_Activity" => "Create Data Location",
            "Asset_ID" => $id_location,
            "Module_Feature" => "Master Location",
       ];
        if($insert){

            
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
        $location = Location::find($request->id);

        return response()->json($location);
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
            'locationcode'           => [
                                         'required',
                                         'max:50',
                                         Rule::unique('db_location')->ignore($request->id,'id'),
                                        ],
            'locationname'           => 'required|max:50',
            'country'                   => 'required|max:25',
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal mengubah data','errors' => $validator->errors()],422);
        }

        $data = [
            'locationcode'           => $request->locationcode,
            'locationname'           => $request->locationname,       
            'country'                   => $request->country,
            
        ];
        $update = Location::where('id',$request->id)->update($data);
        $data_audit = [
            "ChangedDateandTime" =>date('d-m-Y H:i:s'),
            "UserID" => Auth::user()->name,
            "Action_Activity" => "Edit Data Location",
            "Asset_ID" => $request->locationcode,
            "Module_Feature" => "Master Location",
         ];
        $audit = Audit::create($data_audit);

        if($update){
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
        // Delete Multi Table
        // Ketika Big data di delete otomatis location_sub dan location_smnya di delete juga
        $location = Location::where('db_location.id', $id)->first();       
        $data_audit = [
            "ChangedDateandTime" =>date('d-m-Y H:i:s'),
            "UserID" => Auth::user()->name,
            "Action_Activity" => "Delete Data Location BIG",
            "Asset_ID" => $location->locationcode,
            "Module_Feature" => "Master Location",
        ];
        
        Location_sub::where('locationcode_big', $id)->delete();                           
        Location_sm::where('locationcode_big', $id)->delete();                           
        $location->delete();
        
        if($location){
            $audit = Audit::create($data_audit);
            return response()->json(['message'=>'Berhasil menghapus data terkait.'],200);
        }else{
            return response()->json(['message'=>'Gagal menghapus data terkait.'],422);
        }
    }
  
}
