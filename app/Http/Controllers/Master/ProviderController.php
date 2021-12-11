<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Http\Controllers\Controller;
use App\Exports\ServiceProviderExport;
use App\Imports\ProviderImport;
use App\Models\Provider;
use App\Models\Audit;

use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use DB;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
        return view('master/provider_views/provider');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Provider = Provider::get();

        return Datatables::of($Provider)->make(true);
    }
    public function import_excel(Request $request) 
	{
		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
	    // tangkap file dan import
        $import = Excel::toArray(new ProviderImport, request()->file('file'));
        collect(head($import))->each(function ($row) { 
        Provider::where('providercode',$row['provider_code'])->update([
            'providercode'=>$row['provider_code'],
            'providername'=>$row['provider_name'],
            'contact'=>$row['contact'],
            'address'=>$row['address'],
            'OpeningDate'=>$row['opening_date'],
            'city'=>$row['city'],
            'postal'=>$row['postal'],
            'phone'=>$row['phone'],
            'fax'=>$row['fax'],
            ]);
        });
        Excel::import(new ProviderImport,request()->file('file'));
 
		// alihkan halaman kembali
		if($import){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('d-m-Y H:i:s');
            $data_audit = [
                "ChangedDateandTime" =>$date,
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Import Provider",
                "Module_Feature" => "Master Service Provider",
            ];

            $audit = Audit::create($data_audit);

            return redirect()->back();
        }else{
            return response()->json(['message'=>'Gagal menambah data','errors' => $import]);
        }


	}

    public function export(){
        return Excel::download(new ServiceProviderExport, 'Provider.xlsx');
    }

    public function print(){
        $data = Provider::all();
        return view('master/provider_views/provider_print',['provider_print'=>$data]);
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
            "providername" => "required|max:100",
            "pcontact"     => "required|max:25",
            "paddress"     => "required|max:255",
            "pfax"         => "required|max:15",
            "pcity"        => "required|max:25",
            "pphone"       => "required|max:30",
            "ppostal"      => "required|max:10",
            "npwp"         => "required|max:15",
            "pOpeningDate" => "required|max:15",
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal menambah data','errors' => $validator->errors()],422);
        }
        $id = IdGenerator::generate(['table' => 'db_provider','field'=>'providercode', 'length' => 6, 'prefix' =>'PVD']);
        $data = [
            "providercode" => $id,
            "providername" => $request->providername,
            "address"     => $request->paddress,
            "fax"         => $request->pfax,
            "city"        => $request->pcity,
            "phone"       => $request->pphone,
            "postal"      => $request->ppostal,
            "telex"       => $request->npwp,
            "OpeningDate" => $request->pOpeningDate,
            "contact"     => $request->pcontact
        ];

        $insert = Provider::create($data);
       
        if($insert){
            
            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Create Data Provider",
                "Asset_ID" => $id,
                "Module_Feature" => "Master Provider",
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
    public function show(Request $request,$id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        //
        $Provider = Provider::find($request->id);

        return response()->json($Provider);
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
            "providercode" => [
                                'required',
                                'max:100',
                                Rule::unique('db_provider')->ignore($request->id),
                            ],
            "providername" => "required|max:100",
            "pcontact"     => "required|max:25",
            "paddress"     => "required|max:255",
            "pfax"         => "required|max:15",
            "pcity"        => "required|max:25",
            "pphone"       => "required|max:30",
            "ppostal"      => "required|max:10",
            "npwp"         => "required|max:15",
            "pOpeningDate" => "required|max:15",
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal menambah data','errors' => $validator->errors()],422);
        }

        $data = [
            "providercode" => $request->providercode,
            "providername" => $request->providername,
            "address"     => $request->paddress,
            "fax"         => $request->pfax,
            "city"        => $request->pcity,
            "phone"       => $request->pphone,
            "postal"      => $request->ppostal,
            "telex"       => $request->npwp,
            "OpeningDate" => $request->pOpeningDate,
            "contact"     => $request->pcontact
        ];
        
        $update = Provider::where('id',$request->id)->update($data);

        if($update){
            
            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Edit Data Provider",
                "Asset_ID" => $request->providercode,
                "Module_Feature" => "Master Provider",
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
        $Provider = Provider::find($id);

        $data_audit = [
            "ChangedDateandTime" =>date('d-m-Y H:i:s'),
            "UserID" => Auth::user()->name,
            "Action_Activity" => "Delete Data Provider",
            "Asset_ID" => $Provider->providercode,
            "Module_Feature" => "Master Provider",
        ];

        $Provider = $Provider->delete();
        
        if($Provider){

            $audit = Audit::create($data_audit);
            
            return response()->json(['message'=>'Berhasil menghapus data terkait.'],200);
        }else{
            return response()->json(['message'=>'Gagal menghapus data terkait.'],422);
        }
    }
}
