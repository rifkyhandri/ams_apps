<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Asset;
use App\Models\Asset_transaction;
use App\Models\Audit;
use Yajra\Datatables\Datatables;

class AssetHistoryController extends Controller
{
    public function index(){
        return view('report.assethistory');
    }

    public function get_data(Request $request){
        
        $audit = Audit::where('Action_Activity',"Updated Asset Register");

        if(!empty($request->filtertagnumber)){
            $audit->where('Asset_ID',$request->filtertagnumber);
        }

        $audit->get();

        return Datatables::of($audit)->make(true);
    
    }

}
