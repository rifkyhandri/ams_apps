<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/* MODELS */
use App\Models\Asset;
use DB;

/* EXPORT */
use App\Exports\report_summary\ReportDetailCom;
use App\Exports\report_summary\ReportCommercial;

/* VENDOR */
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class SumarryController extends Controller
{
    //
    public function index(){
        return view('report.sumarry');
    }

    public function get_data(Request $request){
    
        $sumarry = Asset::select(
                            '*','asset_id as id',
                            DB::RAW("YEAR(CURDATE()) - YEAR(dateacq) - (DATE_FORMAT(CURDATE(), '%m%d') < DATE_FORMAT(dateacq, '%m%d')) as useful"),
                            DB::RAW("DATE_ADD(dateacq,INTERVAL lifetimeyear YEAR) as duedate"),
                            )
                        ->with('objcostgroup')
                        ->with(array('objlocation'=>function($query){
                            $query->with(array('location_big'=>function($location_big){
                                $location_big->select('id','locationname');
                            },'location_sub'=>function($location_sub){
                                $location_sub->select('id','locationname_sub');
                            }));
                        }));
        
        if(!empty($request->filtercostgroup)){
            $sumarry->whereIn('assetgroup',$request->filtercostgroup);
        }

        if(!empty($request->filterstartdate) && !empty($request->filterenddate)){
            $sumarry->whereBetween('dateacq',[$request->filterstartdate,$request->filterenddate]);
        }

        $sumarry->get();

        return Datatables::of($sumarry)->make(true);
    }

    public function get_data_fa(Request $request){

        $FA = Asset::select('assetgroup',DB::RAW('SUM(purchaseacq) as FA'))
                   ->with('objcostgroup')
                   ->groupBy('assetgroup');
      
        if(!empty($request->filtercostgroup)){
            $FA->whereIn('assetgroup',$request->filtercostgroup);
        }
        
        $FA->get();

        return Datatables::of($FA)->make(true);
        
    }

    public function export_summary(Request $request){
        return Excel::download(new ReportDetailCom($request), 'detailcom-'.NOW()->format('Y-m-d').'.xlsx');
    }

    public function export_fa(Request $request){
        return Excel::download(new ReportCommercial($request), 'commercial-'.NOW()->format('Y-m-d').'.xlsx');
    }
}
