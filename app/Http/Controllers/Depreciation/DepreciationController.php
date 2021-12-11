<?php

namespace App\Http\Controllers\Depreciation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Collection;

use App\Http\Controllers\Controller;
use App\Models\Asset;

use Yajra\Datatables\Datatables;
use Maatwebsite\Excel\Facades\Excel;


class DepreciationController extends Controller
{
    //
    public function index(){
        return view('depreciation.depreciation');
    }

    public function show(Request $request,$tag){
        return view('depreciation.detail');
    }

    public function get_asset(Request $request,$tag){

        $tag = str_replace('%20',' ', $tag);
     
        $asset = Asset::where('tangnumber',$tag)
                        ->whereNotNull(['dateacq','purchaseacq'])
                        ->get();

        if(!isset($asset[0])){
            return Datatables::of($asset)->make(true);
        }
      
        $asset = $asset->first();
        /* TIME */
        $year = $asset->lifetimeyear * 12;
        $month = $asset->livetimemonth;
        $dateacq = Carbon::createFromFormat('Y-m-d',$asset->dateacq);
        $yearacq = Carbon::createFromFormat('Y-m-d',$asset->dateacq)->format('Y');
        $monthacq = Carbon::createFromFormat('Y-m-d',$asset->dateacq)->format('m');
        $datepurchase = Carbon::createFromFormat('Y-m-d',$asset->datepurchase)->subMonths(2);
        //sisa bulan 
        $sisa_bulan = 12 - $monthacq + 1;
        
        if($asset->comdepreciation == 'Straight Line'){
        
            /* VALUE */
            $accu = 0;
            $monthperyear = (0.0833333333 * $asset->livetimemonth);
            //annual depr
            $annualdepr = ($asset->purchaseacq - $asset->salvage1) / ($asset->lifetimeyear + $monthperyear);
            //month depr
            $monthdepr = $annualdepr/12;
            //deprrate
            $deprrate = $annualdepr/($asset->purchaseacq - $asset->salvage1);
            //book value 
            $book_value = $asset->purchaseacq;
        
        }

        if($asset->comdepreciation == 'Non depreciable'){
            /* VALUE */
            $accu = 0;
            $monthperyear = (0.0833333333 * $asset->livetimemonth);
            //annual depr
            $annualdepr = 0;
            //month depr
            $monthdepr = $annualdepr/12;
            //deprrate
            // $deprrate = $annualdepr/($asset->purchaseacq - $asset->salvage1);
            //book value
            $book_value = $asset->purchaseacq;
        }

        if($asset->comdepreciation == 'Decline'){
            /* VALUE */
            $accu = 0;
            $monthperyear = (0.0833333333 * $asset->livetimemonth);
            //annual depr
            $annualdepr = ($asset->purchaseacq - $asset->salvage1) / ($asset->lifetimeyear + $monthperyear);
            //month depr
            $monthdepr = $annualdepr/12;
            //deprrate
            $deprrate = 1/($asset->lifetimeyear + $monthperyear) * 1.5;
            //book value
            $book_value = $asset->purchaseacq;
        }
      
        if($asset->comdepreciation == 'Double Decline'){
            /* VALUE */
            $accu = 0;
            $monthperyear = (0.0833333333 * $asset->livetimemonth);
            //annual depr
            $annualdepr = ($asset->purchaseacq - $asset->salvage1) / ($asset->lifetimeyear + $monthperyear);
            //month depr
            $monthdepr = $annualdepr/12;
            //deprrate
            $deprrate = 1/($asset->lifetimeyear + $monthperyear) * 2;
            //book value
            $book_value = $asset->purchaseacq;
        }

        if($asset->comdepreciation == 'Sum of year digits'){
            /* VALUE */
            $accu = 0;
            $monthperyear = (0.0833333333 * $asset->livetimemonth);
            $deprrate = array();
            $annualdepr = array();
            $monthdepr = array();

            $amount_depr = ($asset->purchaseacq - $asset->salvage1);
            //for calcutation amount
            $calc_amount = $amount_depr;
            $sum_life = 0;
            $lifeasset = $asset->lifetimeyear;
             //sum of use life
             for ($i=$lifeasset; $i > 0; $i--) { 
                $sum_life += $i;
            }
            
            for ($d=$lifeasset; $d > 0 ; $d--) { 
                # code...
                $deprrate[] = $d / $sum_life;
                if($d==0){
                    $annualdepr[] = $calc_amount;
                    $monthdepr [] = $calc_amount/12;
                }else{
                    $annualdepr[] = $amount_depr * ($d/$sum_life);
                    $monthdepr[] = ($amount_depr * ($d/$sum_life)) / 12;
                }

                $calc_amount -= $amount_depr * ($d/$sum_life);
            }

            //book value
            $book_value = $asset->purchaseacq;
        }

        $depreciation = collect();
        
        $flag = 0;
        $breakloop = false;

        for ($i=1; $i <= ($year+$month)  ; $i++) { 

            $date = $dateacq->addMonths(1);
            $caclcdate = $date;
            $fiscal = $datepurchase->addMonths(1);

            switch ($asset->comdepreciation) {
                case 'Straight Line':
                    $new_book = number_format($book_value -= $monthdepr,2,".","");
                    $new_depr = number_format($monthdepr,2,".","");
                    $new_accu = number_format($accu += $monthdepr,2,".","");
                    break;
                case 'Non depreciable':
                    $new_book = number_format($book_value -= $monthdepr,2,".","");
                    $new_depr = number_format($monthdepr,2,".","");
                    $new_accu = number_format($accu += $monthdepr,2,".","");
                    break;
                case 'Decline':
                    if($caclcdate->format('m') == '02' && $caclcdate->format('Y') != $yearacq){
                        $diff = 12;
                        $book_value = $asset->purchaseacq - $accu;
                    }else{
                        $diff = 12 - $monthacq + 1;
                    }
                   
                    if(($asset->purchaseacq - $accu) < ($asset->salvage1 + (($book_value * $deprrate * $diff / 12) / $diff))){
                        $breakloop = true;
                        break;
                    }

                    $new_depr = number_format(($book_value * $deprrate * $diff / 12) / $diff ,2,".","");
                    $new_accu = number_format($accu += $new_depr,2,".","");
                    $new_book = number_format($asset->purchaseacq - $accu,2,".","");
                   
                    break;
                case 'Double Decline':
                    if($caclcdate->format('m') == '02' && $caclcdate->format('Y') != $yearacq){
                        $diff = 12;
                        $book_value = $asset->purchaseacq - $accu;
                    }else{
                        $diff = 12 - $monthacq + 1;
                    }
                    
                    if(($asset->purchaseacq - $accu) < ($asset->salvage1 + (($book_value * $deprrate * $diff / 12) / $diff))){
                        $breakloop = true;
                        break;
                    }

                    $new_depr = number_format(($book_value * $deprrate * $diff / 12) / $diff ,2,".","");
                    $new_accu = number_format($accu += $new_depr,2,".","");
                    $new_book = number_format($asset->purchaseacq - $accu,2,".","");
                    break;
                case 'Sum of year digits':
                    if($caclcdate->format('m') == '02' && $caclcdate->format('Y') != $yearacq){
                        if($flag >= (count($monthdepr)-1)){
        
                        }else{
                            $flag++;
                        }   
                    }
                    
                    if($book_value < ($asset->salvage1 + $monthdepr[$flag])){
                        $breakloop = true;
                        break;
                    }

                    $book_value = $asset->purchaseacq - $asset->salvage1 - $accu;

                    $new_depr = number_format($monthdepr[$flag],2,".","");
                    $new_accu = number_format($accu += $new_depr,2,".","");
                    $new_book = number_format($book_value,2,".","");
                    break;
                
                default:
                    # code...
                    break;
            }
            
            if($breakloop == true){
                break;
            }

            $data = [
                'calcdate'   => $caclcdate->format('m'),
                'flag'       => $flag,
                'asset'      => $asset,
                'date'       => $date->format('Y-m'),
                'fiscal'     => $fiscal->format('Y-m'),
                'age'        => $i,
                'book_value' => $new_book,
                'depr_value' => $new_depr,
                'depr_accu'  => $new_accu,
            ];

            $depreciation->add($data);
        }
        
        if(!empty($request->filterdate)){
            
           $filterdate = explode("-",$request->filterdate);

           $depreciation = $depreciation->where('date',$filterdate[0]."-".$filterdate[1]);
          
           if(empty($depreciation[0]["date"])){
                $depreciation = $depreciation->add($asset);
           }
        }
        
        return Datatables::of($depreciation)->make(true);
    }
}
