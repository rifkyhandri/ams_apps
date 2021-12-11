<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use App\Models\Asset_transaction;
use App\Models\Asset;
// Excel
use App\Exports\report_transaction\ReportTransferLocation;
use App\Exports\report_transaction\ReportDisposal;
use App\Exports\report_transaction\ReportWriteOf;
use App\Exports\report_transaction\ReportRevaluation;
use App\Exports\report_transaction\ReportPurchase;
// vendor
use Maatwebsite\Excel\Facades\Excel;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Yajra\Datatables\Datatables;

class TransactionController extends Controller
{
    public function index(){
        return view('report.transactions');
    }
    public function get_data(Request $request){
        $transaction = Asset_transaction::with('approveasset')
                                        ->with('approvecostcenter')
                                        ->with('approvecustodian')
                                        ->with(array('approvelocation'=>function($query){
                                            $query->with(array('location_big'=>function($location_big){
                                                $location_big->select('id','locationname');
                                            },'location_sub'=>function($location_sub){
                                                $location_sub->select('id','locationname_sub');
                                            }));
                                         }))->where('approval',1);  
        if(!empty($request->filterstartdate) && !empty($request->filterenddate)){
            $transaction->whereBetween('transaction_date',[$request->filterstartdate,$request->filterenddate]);
            // get_disposal?filterstartservice=2021-03-10&filterendservice=2021-03-16
        }
       if(!empty($request->filterDisposal)){
            $transaction->where('transaction_name','Disposal');
        }
       if(!empty($request->filterTransfer)){
            $transaction->where('transaction_name','Relocation Request');
        }
       if(!empty($request->filterWriteoff)){
            $transaction->where('transaction_name','Write off');
        }
       if(!empty($request->filterRevalue)){
            $transaction->where('transaction_name','Revalue');
        }
        $transaction->get();
        return Datatables::of($transaction)->make(true);
    }

    public function get_purchase(Request $request){
        $asset = Asset::with('objassetstatus');
        if(!empty($request->filterstartdate) && !empty($request->filterenddate)){
            $asset->whereBetween('datepurchase',[$request->filterstartdate,$request->filterenddate]);
        }
        $asset->get();
        return Datatables::of($asset)->make(true);
    }
    // Export to Excel
    public function reporttransfer_Excel(Request $request){
        return Excel::download(new ReportTransferLocation($request), 'transfer-'.NOW()->format('Y-m-d').'.xlsx');
    }
    public function reportdisposal_Excel(Request $request){
        return Excel::download(new ReportDisposal($request), 'disposal-'.NOW()->format('Y-m-d').'.xlsx');
    }
    public function reportwriteoff_Excel(Request $request){
        return Excel::download(new ReportWriteOf($request), 'writeoff-'.NOW()->format('Y-m-d').'.xlsx');
    }
    public function revaluation_Excel(Request $request){
        return Excel::download(new ReportRevaluation($request), 'revalue-'.NOW()->format('Y-m-d').'.xlsx');
    }
    public function purchase_Excel(Request $request){
        return Excel::download(new ReportPurchase($request), 'purchase-'.NOW()->format('Y-m-d').'.xlsx');
    }

    public function printPurchase(Request $request){
        $asset = Asset::with('objassetstatus');
        if(!empty($request->filterstartdate) && !empty($request->filterenddate)){
            $asset->whereBetween('datepurchase',[$request->filterstartdate,$request->filterenddate]);
        }
        $asset = $asset->get();

        return view('print_reporttransaction/print_purchasereport',['purchase_report'=>$asset]);
    }
  public function printDisposal(Request $request){
      $asset = Asset_transaction::with('approveasset')
                                ->where('transaction_name','Disposal')
                                ->where('approval',1);
         if(!empty($request->filterstartdate) && !empty($request->filterenddate)){
            $asset->whereBetween('transaction_date',[$request->filterstartdate,$request->filterenddate]);
        }
       $asset = $asset->get();
        return view('print_reporttransaction/print_disposalreport',['disposal_report'=>$asset]);
  }
  public function printWriteoff(Request $request){
      $asset = Asset_transaction::with('approveasset')
                                ->where('transaction_name','Write off')
                                ->where('approval',1);
         if(!empty($request->filterstartdate) && !empty($request->filterenddate)){
            $asset->whereBetween('transaction_date',[$request->filterstartdate,$request->filterenddate]);
        }
      $asset = $asset->get();
        return view('print_reporttransaction/print_writeoffreport',['writeoff_report'=>$asset]);
  }
  public function printRevaluation(Request $request){
      $asset = Asset_transaction::with('approveasset')
                                ->where('transaction_name','Revalue')
                                ->where('approval',1);
         if(!empty($request->filterstartdate) && !empty($request->filterenddate)){
            $asset->whereBetween('transaction_date',[$request->filterstartdate,$request->filterenddate]);
        }
      $asset->get();
        return view('print_reporttransaction/print_revaluereport',['revalue_report'=>$asset]);
  }
  public function printRelocation(Request $request){
      $asset = Asset_transaction::with('approveasset')
                                ->where('transaction_name','Relocation Request')
                                ->where('approval',1);
         if(!empty($request->filterstartdate) && !empty($request->filterenddate)){
            $asset->whereBetween('transaction_date',[$request->filterstartdate,$request->filterenddate]);
        }
      $asset = $asset->get();
        return view('print_reporttransaction/print_relocationreport',['relocation_report'=>$asset]);
  }

    
    
}
