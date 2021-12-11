<?php

namespace App\Http\Controllers\Master;
use App\Models\Asset;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocationAssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('location_asset/location_asset_wilayah');
    }

    public function location_full(){
        $location = Asset::with(array('objlocation'=>function($query){
            $query->with(array('location_big'=>function($location_big){
                $location_big->select('id','locationname');
            },'location_sub'=>function($location_sub){
                $location_sub->select('id','locationname_sub');
            }));
        }))->find($id);
        return response()->json($location);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function show($id)
    {
        $location = Asset::find($id);
        return view('location_asset/location_asset',['location'=>$location]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
      
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
}
