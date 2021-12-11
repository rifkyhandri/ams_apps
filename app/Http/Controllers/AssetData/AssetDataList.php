<?php

namespace App\Http\Controllers\AssetData;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Exports\AssetDataExport;

use Yajra\Datatables\Datatables;
use Intervention\Image\ImageManagerStatic as Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Maatwebsite\Excel\Facades\Excel;

class AssetDataList extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('assetdata/assetlist_views/assetlist');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // dd($request);
        $Asset = Asset::with('objdepartement')
                        ->with('objcostgroup')
                        ->with(array('objlocation'=>function($query){
                            $query->with(array('location_big'=>function($location_big){
                                $location_big->select('id','locationname');
                            },'location_sub'=>function($location_sub){
                                $location_sub->select('id','locationname_sub');
                            }));
                        }))
                        ->with('objcostcenter')
                        ->with('objcustodian')
                        ->with('objprovider')
                        ->get();

        return Datatables::of($Asset)->make(true);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
       
        $Asset = Asset::with('objdepartement')
                        ->with('objcostgroup')
                        ->with('objcostcenter')
                        ->with('objcustodian')
                        ->with('objprovider');
        if(!empty($request->filtersmlocation)){
            $Asset->with(array('objlocation'=>function($query){
                $query->with(array('location_big'=>function($location_big){
                    if(!empty($request->filterlocation)){
                        $location_big->select('id','locationcode','locationname')->where('locationcode',$request->filterlocation);
                    }else{
                        $location_big->select('id','locationcode','locationname');
                    }
                
                },'location_sub'=>function($location_sub){
                    if(!empty($request->filtersublocation)){
                        $location_sub->select('id','locationcode_sub','locationname_sub')->where('locationcode_sub',$request->filtersublocation);
                    }else{
                        $location_sub->select('id','locationcode_sub','locationname_sub');
                    }
                }));

            }))->where('location',$request->filtersmlocation);
        }else{
            $Asset->with(array('objlocation'=>function($query){
                $query->with(array('location_big'=>function($location_big){
                    if(!empty($request->filterlocation)){
                        $location_big->select('id','locationcode','locationname')->where('locationcode',$request->filterlocation);
                    }else{
                        $location_big->select('id','locationcode','locationname');
                    }
                
                },'location_sub'=>function($location_sub){
                    if(!empty($request->filtersublocation)){
                        $location_sub->select('id','locationcode_sub','locationname_sub')->where('locationcode_sub',$request->filtersublocation);
                    }else{
                        $location_sub->select('id','locationcode_sub','locationname_sub');
                    }
                }));
            }));
        }
                        
        if(!empty($request->filterdepartement)){
            $Asset->where('departement',$request->filterdepartement);
        }

        if(!empty($request->filterassetgroup)){
            $Asset->where('assetgroup',$request->filterassetgroup);
        }

        if(!empty($request->filtervendor)){
            $Asset->where('vendors',$request->filtervendor);
        }

        if(!empty($request->filtercostcenter)){
            $Asset->where('costcenter',$request->filtercostcenter);
        }

        if(!empty($request->filterassettype)){
            $Asset->where('asset_type',$request->filterassettype);
        }

        if(!empty($request->filter_uploaddate)){
            $Asset->whereDate('created_at',$request->filter_uploaddate);
        }

        if(!empty($request->filterdepreciation)){
            $Asset->where('comdepreciation',$request->filterdepreciation)->orWhere('fiscaldepreciation',$request->filterdepreciation);
        }

        if(!empty($request->filtertagnumber)){
            $Asset->where('tangnumber',$request->filtertagnumber);
        }

        if(!empty($request->filterstartservice) && !empty($request->filterendservice)){
            $Asset->whereBetween('nextservice',[$request->filterstartservice,$request->filterendservice]);
        }

        if(!empty($request->filterstartwarranty) && !empty($request->filterendwarranty)){
            $Asset->whereBetween('warranty',[$request->filterstartwarranty,$request->filterendwarranty]);
        }
        $Asset->get();
        return Datatables::of($Asset)->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function print_qr(Request $request){
        $Asset = Asset::with('objdepartement')
                        ->with('objcostgroup')
                        ->with('objcostcenter')
                        ->with('objcustodian');

        if(!empty($request->filtersmlocation)){
            $Asset->with(array('objlocation'=>function($query){
                $query->with(array('location_big'=>function($location_big){
                    if(!empty($request->filterlocation)){
                        $location_big->select('id','locationcode','locationname')->where('locationcode',$request->filterlocation);
                    }else{
                        $location_big->select('id','locationcode','locationname');
                    }
                
                },'location_sub'=>function($location_sub){
                    if(!empty($request->filtersublocation)){
                        $location_sub->select('id','locationcode_sub','locationname_sub')->where('locationcode_sub',$request->filtersublocation);
                    }else{
                        $location_sub->select('id','locationcode_sub','locationname_sub');
                    }
                }));

            }))->where('location',$request->filtersmlocation);
        }else{
            $Asset->with(array('objlocation'=>function($query){
                $query->with(array('location_big'=>function($location_big){
                    if(!empty($request->filterlocation)){
                        $location_big->select('id','locationcode','locationname')->where('locationcode',$request->filterlocation);
                    }else{
                        $location_big->select('id','locationcode','locationname');
                    }
                
                },'location_sub'=>function($location_sub){
                    if(!empty($request->filtersublocation)){
                        $location_sub->select('id','locationcode_sub','locationname_sub')->where('locationcode_sub',$request->filtersublocation);
                    }else{
                        $location_sub->select('id','locationcode_sub','locationname_sub');
                    }
                }));
            }));
        }
                        
        if(!empty($request->filterdepartement)){
            $Asset->where('departement',$request->filterdepartement);
        }

        if(!empty($request->filterassetgroup)){
            $Asset->where('assetgroup',$request->filterassetgroup);
        }

        if(!empty($request->filtervendor)){
            $Asset->where('vendors',$request->filtervendor);
        }

        if(!empty($request->filtercostcenter)){
            $Asset->where('costcenter',$request->filtercostcenter);
        }

        if(!empty($request->filterassettype)){
            $Asset->where('asset_type',$request->filterassettype);
        }

        if(!empty($request->filter_uploaddate)){
            $Asset->whereDate('created_at',$request->filter_uploaddate);
        }

        $Asset = $Asset->get();

        return view('qrcode.asset_qr',['asset'=>$Asset]);
    }

    public function export(Request $request){

        return Excel::download(new AssetDataExport($request), 'assetdata-'.NOW()->format('Y-m-d').'.xlsx');
    
    }
}
