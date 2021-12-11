<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\User;
use App\Models\CostGroup;

use DB;

class DashboardController extends Controller
{
    //
    public function index(){

        $asset_amount = Asset::select(DB::RAW('COUNT(asset_id) as total_asset'))->first();

        $asset_value = Asset::select('assetgroup',DB::RAW('SUM(purchaseacq) as FA'))
                                    ->with('objcostgroup')
                                    ->groupBy('assetgroup')
                                    ->first();
        
        $users_amount = User::select(DB::RAW("COUNT('id') as amount"))->first();

        $costgroup_amount = CostGroup::select(DB::RAW("COUNT('id') as amount"))->first();
        

        return view('main',['asset_value'=>$asset_value,'asset_amount'=>$asset_amount,'users_amount'=>$users_amount,'costgroup_amount'=>$costgroup_amount]);
    }
}
