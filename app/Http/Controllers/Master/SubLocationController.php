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

use Maatwebsite\Excel\Facades\Excel;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Yajra\Datatables\Datatables;

class SubLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->id;

        $location_sub = Location::find($id)->location_sub;

        return Datatables::of($location_sub)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $location_sub = Location_sub::with('location')
                                    ->get();

        return Datatables::of($location_sub)->make(true);
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
            'locationname_sub'       => 'required|max:50',
            'contact'                => 'required|max:30',
            'address'                => 'required|max:255',
            'OpeningDate'            => 'required|max:15',
            'city'                   => 'required|max:25',
            'postal'                 => 'required|max:10',
            'phone'                  => 'required|max:30',
            'fax_sub'                => 'required|max:15',
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal menambah data','errors' => $validator->errors()],422);
        }

        $id_location_sub = IdGenerator::generate(['table' => 'db_location_sub','field'=>'locationcode_sub', 'length' => 7, 'prefix' =>'LSU','reset_on_prefix_change'=>'true']);
        
        $data = [
            'locationcode_sub'           => $id_location_sub,
            'locationcode_big'           => $request->locationcode_big,
            'locationname_sub'           => $request->locationname_sub,
            'contact'                    => $request->contact,
            'address'                    => $request->address,
            'OpeningDate'                => $request->OpeningDate,
            'city'                       => $request->city,
            'postal'                     => $request->postal,
            'phone'                      => $request->phone,
            'fax'                        => $request->fax_sub,
        ];

        $insert = Location_sub::create($data);
        
        if($insert){
            
            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Create Sub Location",
                "Asset_ID" => $id_location_sub,
                "Module_Feature" => "Master Sub Location",
                "Field_Name" => $request->locationname_sub
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
        $location = Location::find($id);
        return view('master/location_views/location_sub',['location'=>$location]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $location_sub = Location_sub::find($request->id);

        return response()->json($location_sub);
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
            'locationcode_sub'           => [
                                         'required',
                                         'max:50',
                                         Rule::unique('db_location_sub')->ignore($request->id,'id'),
                                        ],
            'locationname_sub'       => 'required|max:50',
            'locationcode_big'       => 'required|max:50',
            'contact'                => 'required|max:30',
            'address'                => 'required|max:255',
            'OpeningDate'                => 'required|max:20',
            'city'                   => 'required|max:25',
            'postal'                 => 'required|max:10',
            'phone'                  => 'required|max:30',
            'fax'                    => 'required|max:19',
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal mengubah data bro','errors' => $validator->errors()],422);
        }

        $data = [
            'locationcode_big'           => $request->locationcode_big,
            'locationcode_sub'           => $request->locationcode_sub,
            'locationname_sub'           => $request->locationname_sub,
            'contact'                    => $request->contact,
            'address'                    => $request->address,
            'OpeningDate'                => $request->OpeningDate,
            'city'                       => $request->city,
            'postal'                     => $request->postal,
            'phone'                      => $request->phone,
            'fax'                        => $request->fax,
        ];
        $update = Location_sub::where('id',$request->id)->update($data);
        
        if($update){

            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Edit Data Location Sub",
                "Asset_ID" => $request->locationcode_sub,
                "Module_Feature" => "Master Location Sub",
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
        $location = Location_sub::where('id', $id)->first();   
                            
         Location_sm::where('locationcode_sub', $id)->delete();                           
         $location->delete();
        if($location){   
               $data_audit = [
            "ChangedDateandTime" =>date('d-m-Y H:i:s'),
            "UserID" => Auth::user()->name,
            "Action_Activity" => "Delete Data Location Small",
            "Asset_ID" => $request->locationcode_sub,
            "Module_Feature" => "Master Location Small",
         ];                     
            $audit = Audit::create($data_audit);
            
            return response()->json(['message'=>'Berhasil menghapus data terkait.'],200);
        }else{
            return response()->json(['message'=>'Gagal menghapus data terkait.'],422);
        }
    }

    public function sublocation_filtered(Request $request){
        
        $location_sub = Location_sub::with('location');

        if(!empty($request->filterlocation)){
            $location_sub->where('locationcode_big',$request->filterlocation);
            $location_sub = $location_sub->get();
        }else{
            $location_sub = [];
        }
        return Datatables::of($location_sub)->make(true);
    }
}
