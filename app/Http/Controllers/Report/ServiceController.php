<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use App\Models\Asset;
use App\Models\ServiceLog;
// vendor
use App\Exports\report_transaction\ReportServiceLog;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class ServiceController extends Controller
{
    //
    public function index(){
        return view('report.service');
    }

    public function get_data(Request $request){
        
        $service = ServiceLog::with(array('asset'=>function($query){
                        $query->with(array('objprovider'=>function($provider){
                            $provider->select('providercode','providername');
                        }));
                   }));

        if(!empty($request->filterstartservice) && !empty($request->filterendservice)){
            $service->whereBetween('servicedate',[$request->filterstartservice,$request->filterendservice]);
        }
    
        $service->get();
        return Datatables::of($service)->make(true);
    }
    public function reportservice_Excel(Request $request){
        return Excel::download(new ReportServiceLog($request), 'servicelog-'.NOW()->format('Y-m-d').'.xlsx');
       
    }
    public function printServiceLog(Request $request){
         $service = ServiceLog::with(array('asset'=>function($query){
                        $query->with(array('objprovider'=>function($provider){
                            $provider->select('providercode','providername');
                        }));
                   }));

        if(!empty($request->filterstartservice) && !empty($request->filterendservice)){
            $service->whereBetween('servicedate',[$request->filterstartservice,$request->filterendservice]);
        }
        if(!empty($request->filtertangnumber)){
            $service->where('tangnumber',$request->filtertangnumber);
        }
    
        $service = $service->get();
        // return response()->json($service);
        return view('print_reporttransaction/print_reportservicelog',['service'=>$service]);
    }
}

