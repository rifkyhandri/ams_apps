<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use App\Models\Asset_transaction;
use App\Models\stocktakeLog;
// vendor
use App\Exports\report_transaction\StockTakeExport;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class StocktakeController extends Controller
{
    //
    public function index(){
        return view('report.stocktake');
    }
    
    public function get_data(Request $request){

        $transaction = Asset_transaction::with(array('approveasset'=>function($query){
                                        $query->with(array('objdepartement'=>function($departement){
                                            $departement->select('departementcode','departementdesc');
                                            },
                                            'objlocation'=>function($location){
                                                $location->select('locationcode_sm','locationname_sm');
                                            }));
                                        }))
                                        ->with('approveassetclass')
                                        ->with('approvecondition')
                                        ->where('transaction_name','Stock Take')
                                        ->where('approval',1);
                                        
        if(!empty($request->filtertagnumber)){
            $transaction->where('tangnumber',$request->filtertagnumber);
        }

        if(!empty($request->filterstatus)){
            $transaction->where('change_stock_opname',$request->filterstatus);
        }
       
        if(!empty($request->filterstartstock) && !empty($request->filterendstock)){
            $transaction->whereBetween('transaction_date',[$request->filterstartstock,$request->filterendstock]);
        }
       
        $transaction = $transaction->get();

        return Datatables::of($transaction)->make(true);
    }
    public function stocktake_Excel(Request $request){
        return Excel::download(new StockTakeExport($request), 'stocktake-'.NOW()->format('Y-m-d').'.xlsx');
    }
    public function printStockTake(Request $request){
        $transaction = Asset_transaction::with(array('approveasset'=>function($query){
                                        $query->with(array('objdepartement'=>function($departement){
                                            $departement->select('departementcode','departementdesc');
                                            },
                                            'objlocation'=>function($location){
                                                $location->select('locationcode_sm','locationname_sm');
                                            }));
                                        }))
                                        ->with('approveassetclass')
                                        ->with('approvecondition')
                                        ->where('transaction_name','Stock Take')
                                        ->where('approval',1);
        if(!empty($request->filtertagnumber)){
            $transaction->where('tangnumber',$request->filtertagnumber);
        }

        if(!empty($request->filterstatus)){
            $transaction->where('change_stock_opname',$request->filterstatus);
        }
       
        if(!empty($request->filterstartstock) && !empty($request->filterendstock)){
            $transaction->whereBetween('transaction_date',[$request->filterstartstock,$request->filterendstock]);
        }
       
        $transaction = $transaction->get();
        return view('print_reporttransaction/print_stocktake',['stock_take'=>$transaction]);
    }
}
