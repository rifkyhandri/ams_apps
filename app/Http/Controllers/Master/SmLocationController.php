<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Http\Controllers\Controller;
use App\Imports\LocationImport;
use App\Exports\LocationExport;

use App\Models\Audit;
use App\Models\Location;
use App\Models\Location_sub;
use App\Models\Location_sm;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Yajra\Datatables\Datatables;
use Maatwebsite\Excel\Facades\Excel;

class SmLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $id = $request->id;

        $location_sub = Location_sub::find($id)->location_sm;
       
        return Datatables::of($location_sub)->make(true);
    
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $location_sm = Location_sm::with('location_big')
                                  ->with('location_sub')
                                  ->get();
      
        return Datatables::of($location_sm)->make(true);
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
            'locationcode_big'       => 'required|max:50',
            'locationcode_sub'       => 'required|max:50',
            'locationname_sm'        => 'required|max:50',
            'address'                => 'required|max:255',
            'contact'                => 'required|max:30',
            'OpeningDate'            => 'required|max:15',
            'phone'                  => 'required|max:30',
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal menambah data','errors' => $validator->errors()],422);
        }
        
        $id_location_sm = IdGenerator::generate(['table' => 'db_location_sm','field'=>'locationcode_sm', 'length' => 7, 'prefix' =>'LSM','reset_on_prefix_change'=>'true']);
        
        $data = [
            'locationcode_sm'            => $id_location_sm,
            'locationcode_big'           => $request->locationcode_big,
            'locationcode_sub'           => $request->locationcode_sub,
            'locationname_sm'            => $request->locationname_sm,
            'contact'                    => $request->contact,
            'address_sm'                 => $request->address,
            'OpeningDate'                => $request->OpeningDate,
            'phone'                      => $request->phone,
        ];
        
        $insert = Location_sm::create($data);
        
        if($insert){
            
            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Create Location Small",
                "Asset_ID" => $id_location_sm,
                "Module_Feature" => "Master Location Small",
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
        $location_sm = Location_sub::find($id);
        return view('master/location_views/location_sm',['location_sub'=>$location_sm]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $location_sm = Location_sm::find($request->id);

        return response()->json($location_sm);
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
            'locationcode_sm'           => [
                                         'required',
                                         'max:50',
                                         Rule::unique('db_location_sm')->ignore($request->id,'id'),
                                        ],
            'contact'                => 'required|max:30',
            'address'                => 'required|max:255',
            'OpeningDate'            => 'required|max:20',
            'phone'                  => 'required|max:30',
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal mengubah data','errors' => $validator->errors()],422);
        }

        $data = [
            'locationcode_big'           => $request->locationcode_big,
            'locationcode_sub'           => $request->locationcode_sub,
            'locationcode_sm'           => $request->locationcode_sm,
            'locationname_sm'           => $request->locationname_sm,
            'contact'                    => $request->contact,
            'address_sm'                    => $request->address,
            'OpeningDate'                => $request->OpeningDate,
            'phone'                      => $request->phone,
          
        ];
        $update = Location_sm::where('id',$request->id)->update($data);
        
        if($update){
            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Edit Data Location Small",
                "Asset_ID" => $request->locationcode_sm,
                "Module_Feature" => "Master Location Small",
             ];

            $audit = Audit::create($data_audit);
            
            return response()->json(['message'=>'Berhasil mengubah data!'],200);
        }else{
            return response()->json(['message'=>'Gagal mengubah data ','errors' => $update],422);
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
        $location = Location_sm::find($id);       
        $data_audit = [
            "ChangedDateandTime" =>date('d-m-Y H:i:s'),
            "UserID" => Auth::user()->name,
            "Action_Activity" => "Delete Data Location Small",
            "Asset_ID" => $location->locationcode_sm,
            "Module_Feature" => "Master Location Small",
         ];
         $location = $location->delete();
        if($location){
            $audit = Audit::create($data_audit);
            return response()->json(['message'=>'Berhasil menghapus data terkait.'],200);
        }else{
            return response()->json(['message'=>'Gagal menghapus data terkait.'],422);
        }
    }
    
    public function smlocation_filtered(Request $request){
        
        $location_sm = Location_sm::with('location_big')
                                   ->with('location_sub');

        if(!empty($request->filterlocation) && !empty($request->filtersublocation)){
            $location_sm->where('locationcode_big',$request->filterlocation)->where('locationcode_sub',$request->filtersublocation);
            $location_sm = $location_sm->get();
        }else{
            $location_sm = [];
        }


        return Datatables::of($location_sm)->make(true);
    }


}
