<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Audit;
use App\Imports\AssetImport;

use Yajra\Datatables\Datatables;
use Intervention\Image\ImageManagerStatic as Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Maatwebsite\Excel\Facades\Excel;

class AssetController extends Controller
{
    //
    public function get_asset(){
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
                        ->get();
        if($Asset){
            return  response()->json(['success'=>'Succesfully get the data','asset'=> $Asset],200);
        }else{
            return  response()->json(['failed'=>'Failed to deleted data','data'=> $Asset],422);
        }

    }


    public function get_asset_tagnumber($tagnumber){

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
                        ->with('objassettype')
                        ->where('tangnumber',$tagnumber)
                        ->get();

        if(count($Asset) > 0){
            return  response()->json(['success'=>'Succesfully get the data','asset'=> $Asset],200);
        }else{
            return  response()->json(['failed'=>'Failed to deleted data','tagnumber'=> $tagnumber],422);
        }

    }

    

    public function store(Request $request)
    {
        $validation_value = [
            "assetcode"         => "required|unique:db_asset,tangnumber|max:50",
            "regasset_class"    => "max:50",//"required",
            "regcustodian"      => "max:50",//"required",
            "regdepartement"    => "max:15",//"required",
            "regcostgroup"      => "max:50",//"required",
            "reglocation"       => "max:50",//"required",
            "regcostcenter"     => "max:50",//"required",
            "regvendor"         => "max:50",//"required",
            "regmodel"          => "max:25",//"required",
            "regcondition"      => "max:50",//"required",
            "regdesc"           => "max:150",//"required",
            "regnotes"          => "max:25",//"required",
            // "reginvoice"        => "",//"required",
            "regpo_number"      => "max:10",//"required",
            "reglicense"        => "max:25",//"required",
            "regprc_date"       => "max:15",//"required",
            "regacq_date"       => "max:15",//"required",
            "regprc_cost"       => "max:25",//"required",
            "regacq_cost"       => "max:25",//"required",
            "regyear"           => "max:5",//"required",
            "regmonth"          => "max:5",//"required",
            "regdepreciation"   => "max:50",//"required",
            "regsalvage"        => "max:25",//"required",
            "regdepr"           => "max:5",//"required",
            "regprovider"       => "max:50",//"required",
            "regnext_service"   => "max:15",//"required",
            "regwarranty"       => "max:15",//"required",
            "regcontract"       => "max:50",//"required",
            "regtagging"        => "max:15",//"required",
            "regbrand"          => "max:50",//"required",
            "regmanufacture"    => "max:50",//"required",
            "regsoftware"       => "max:50",//"required",
            "regpart"           => "max:50",//"required",
            "regowner"          => "max:50",//"required",
            "regassettype"      => "max:50",//"required",
            "regip_address"     => "max:50",//"required",
            "regassetstatus"    => "max:50",//"required",
            "reglat"            => "max:25",//"required",
            "reglong"           => "max:25",//"required",
            "regaccount"        => "max:25",
            "regimg"            => "mimes:jpg,bmp,png|max:500000",
            "regatt1"           => "mimes:jpg,bmp,png,pdf|max:500000",
            "regatt2"           => "mimes:jpg,bmp,png,pdf|max:500000",
            "regatt3"           => "mimes:jpg,bmp,png,pdf|max:500000",
        ];
        
        $validator = Validator::make($request->all(),$validation_value);
        
        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal menambah datas','errors' => $validator->errors()],422);
        }
        
        /* PATH */
        $path = date("Y").'/'.date("m")."/";
        $destinationPath = public_path('assets/images/'.$path);
        $destinationAtt = public_path('assets/attachment/'.$path);
        
        if (!is_dir($destinationPath) || !is_dir($destinationAtt)) {
            mkdir($destinationPath, 0775, true);
            mkdir($destinationAtt, 0775, true);
        }

        /* COMPRESS IMAGE */
        if(!empty($request->regimg)){
            $img = Image::make($request->regimg);
        
            $img->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $imgname = $request->assetcode."-".time(). '.' . $request->regimg->getClientOriginalExtension();
        }else{
            $img = false;
            $imgname = 'default.jpg';
        }
        /* END COMPRESS IMAGE */

        /* UPLOAD IMAGE AND FILE*/
        if($img){
            $img->save($destinationPath.$imgname,100);
            $imgname = $path.$imgname;
            $upload_date = NOW()->format('Y-m-d');
        }else{
            $upload_date = null;
            // return response()->json(['message'=>'Gagal menyimpan gambar.'],422);
        }

        if(!empty($request->regatt1)){
            $att1    = $path.$request->assetcode."-att1-".$request->regatt1->getClientOriginalName();
            $request->regatt1->move($destinationAtt,$att1);
            $upload_date = NOW()->format('Y-m-d');
        }else{
            $att1 = 'default-att.pdf';
        }

        if(!empty($request->regatt2)){
            $att2    = $path.$request->assetcode."-att2-".$request->regatt2->getClientOriginalName();
            $request->regatt2->move($destinationAtt,$att2);
            $upload_date = NOW()->format('Y-m-d');
        }else{
            $att2 = 'default-att.pdf';
        }

        if(!empty($request->regatt3)){
            $att3    = $path.$request->assetcode."-att3-".$request->regatt3->getClientOriginalName();
            $request->regatt3->move($destinationAtt,$att3);
            $upload_date = NOW()->format('Y-m-d');
        }else{
            $att3 = 'default-att.pdf';
        }

       
        /* END UPLOAD IMAGE AND FILE */

        $data = [
            "tangnumber"        => $request->assetcode,
            "assetname"         => $request->regdesc,
            "asset_type"        => $request->regassettype,
            "models"            => $request->regmodel,
            "notes"             => $request->regnotes,
            "assetclass"        => $request->regasset_class,// belum dibuat harusnya taxcategory
            "custodian"         => $request->regcustodian,
            "assetgroup"        => $request->regcostgroup,
            "costcenter"        => $request->regcostcenter,
            "asCondition"       => $request->regcondition,
            "location"          => $request->reglocation,
            "departement"       => $request->regdepartement,
            "vendors"           => $request->regvendor,
            "account"           => $request->regaccount,
            "payment"           => $request->regpo_number,
            "serial"            => $request->reglicense,
            "datepurchase"      => $request->regprc_date,
            "dateacq"           => $request->regacq_date,
            "purchasecost"      => $request->regprc_cost,
            "purchaseacq"       => $request->regacq_cost,
            "lifetimeyear"      => $request->regyear,
            "livetimemonth"     => $request->regmonth,
            "comdepreciation"   => $request->regdepreciation,
            "fiscaldepreciation"=> $request->regdepreciation,
            "salvage1"          => $request->regsalvage,
            "bookrate"          => $request->regdepr,
            "serviceprovider"   => $request->regprovider,
            "nextservice"       => $request->regnext_service,
            "warranty"          => $request->regwarranty,
            "servicecontract"   => $request->regcontract,
            "tagged"            => $request->regtagging,
            "brand"             => $request->regbrand,
            "manufacture"       => $request->regmanufacture,
            "partnumber"        => $request->regpart,
            "ownership"         => $request->regowner,
            "ESN"               => $request->regsoftware,
            "IP"                => $request->regip_address,
            "asstatus"          => $request->regassetstatus,
            "gps_lat"           => $request->reglat,
            "gps_long"          => $request->reglong,
            "filename"          => $imgname, 
            "att1"              => $att1,
            "att2"              => $att2,
            "att3"              => $att3,
            "upload_date"       => $upload_date,
        ];

        $insert = Asset::create($data);

        if($insert){
            
            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Create Asset Register",
                "Asset_ID" => $request->assetcode,
                "Module_Feature" => "Asset Register",
            ];

            $audit = Audit::create($data_audit);

            return response()->json(['message'=>'Berhasil menambah data!'],200);
        }else{
            return response()->json(['message'=>'Gagal menambah data','errors' => $insert],422);
        }
    }

    public function update(Request $request, $id)
    {   
        $validation_value = [
            "assetcode"           =>   [
                                            'required',
                                            'max:50',
                                            Rule::unique('db_asset','tangnumber')->ignore($request->id,'asset_id'),
                                        ],
            "regasset_class"    => "max:50",//"required",
            "regcustodian"      => "max:50",//"required",
            "regdepartement"    => "max:15",//"required",
            "regcostgroup"      => "max:50",//"required",
            "reglocation"       => "max:50",//"required",
            "regcostcenter"     => "max:50",//"required",
            "regvendor"         => "max:50",//"required",
            "regmodel"          => "max:25",//"required",
            "regcondition"      => "max:50",//"required",
            "regdesc"           => "max:150",//"required",
            "regnotes"          => "max:25",//"required",
            // "reginvoice"        => "",//"required",
            "regpo_number"      => "max:10",//"required",
            "reglicense"        => "max:25",//"required",
            "regprc_date"       => "max:15",//"required",
            "regacq_date"       => "max:15",//"required",
            "regprc_cost"       => "max:25",//"required",
            "regacq_cost"       => "max:25",//"required",
            "regyear"           => "max:5",//"required",
            "regmonth"          => "max:5",//"required",
            "regdepreciation"   => "max:50",//"required",
            "regsalvage"        => "max:25",//"required",
            "regdepr"           => "max:5",//"required",
            "regprovider"       => "max:50",//"required",
            "regnext_service"   => "max:15",//"required",
            "regwarranty"       => "max:15",//"required",
            "regcontract"       => "max:50",//"required",
            "regtagging"        => "max:15",//"required",
            "regbrand"          => "max:50",//"required",
            "regmanufacture"    => "max:50",//"required",
            "regsoftware"       => "max:50",//"required",
            "regpart"           => "max:50",//"required",
            "regowner"          => "max:50",//"required",
            "regassettype"      => "max:50",//"required",
            "regip_address"     => "max:50",//"required",
            "regassetstatus"    => "max:50",//"required",
            "reglat"            => "max:25",//"required",
            "reglong"           => "max:25",//"required",
            "regaccount"        => "max:25",
            "regimg"            => "mimes:jpg,bmp,png|max:500000",
            "regatt1"           => "mimes:jpg,bmp,png,pdf|max:500000",
            "regatt2"           => "mimes:jpg,bmp,png,pdf|max:500000",
            "regatt3"           => "mimes:jpg,bmp,png,pdf|max:500000",
        ];
       
        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal mengubah data','errors' => $validator->errors()],422);
        }

        $data = [
            "assetname"         => $request->regdesc,
            "asset_type"        => $request->regassettype,
            "models"            => $request->regmodel,
            "notes"             => $request->regnotes,
            "assetclass"        => $request->regasset_class,// belum dibuat harusnya taxcategory
            "custodian"         => $request->regcustodian,
            "assetgroup"        => $request->regcostgroup,
            "costcenter"        => $request->regcostcenter,
            "asCondition"       => $request->regcondition,
            "location"          => $request->reglocation,
            "departement"       => $request->regdepartement,
            "vendors"           => $request->regvendor,
            "account"           => $request->regaccount,
            "payment"           => $request->regpo_number,
            "serial"            => $request->reglicense,
            "datepurchase"      => $request->regprc_date,
            "dateacq"           => $request->regacq_date,
            "purchasecost"      => $request->regprc_cost,
            "purchaseacq"       => $request->regacq_cost,
            "lifetimeyear"      => $request->regyear,
            "livetimemonth"     => $request->regmonth,
            "comdepreciation"   => $request->regdepreciation,
            "fiscaldepreciation"=> $request->regdepreciation,
            "salvage1"          => $request->regsalvage,
            "bookrate"          => $request->regdepr,
            "serviceprovider"   => $request->regprovider,
            "nextservice"       => $request->regnext_service,
            "warranty"          => $request->regwarranty,
            "servicecontract"   => $request->regcontract,
            "tagged"            => $request->regtagging,
            "brand"             => $request->regbrand,
            "manufacture"       => $request->regmanufacture,
            "partnumber"        => $request->regpart,
            "ownership"         => $request->regowner,
            "ESN"               => $request->regsoftware,
            "IP"                => $request->regip_address,
            "asstatus"          => $request->regassetstatus,
            "gps_lat"           => $request->reglat,
            "gps_long"          => $request->reglong,
        ];

        $before = Asset::where('asset_id',$request->id)->exclude(['created_at','updated_at'])->first();
      
        if($request->assetcode == $before->tangnumber){
            $data += [
                "tangnumber"        => $request->assetcode,
            ];
        }else{
            $data += [
                "old_tagnumber"     => $before->tangnumber,
                "tangnumber"        => $request->assetcode,
            ];
        }

        /* PATH */
        $path = date("Y").'/'.date("m")."/";
        $destinationPath = public_path('assets/images/'.$path);
        $destinationAtt = public_path('assets/attachment/'.$path);
        
        if (!is_dir($destinationPath) || !is_dir($destinationAtt)) {
            mkdir($destinationPath, 0775, true);
            mkdir($destinationAtt, 0775, true);
        }

        /* COMPRESS IMAGE */
        if(!empty($request->regimg)){
            $img = Image::make($request->regimg);
        
            $img->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $imgname = $request->assetcode."-".time(). '.' . $request->regimg->getClientOriginalExtension();
        
        }else{
            $img = false;
            $imgname = 'default.jpg';
        }
        /* END COMPRESS IMAGE */

        /* UPLOAD IMAGE AND FILE*/
        if(!empty($request->regatt1)){
            $att1    = $path.$request->assetcode."-att1-".$request->regatt1->getClientOriginalName();
            $request->regatt1->move($destinationAtt,$att1);
            $upload_date = NOW()->format('Y-m-d');

            $data += [
                "att1"          => $att1,
                "upload_date"       => $upload_date,
            ];

        }else{
            $att1 = 'default-att.pdf';
        }

        if(!empty($request->regatt2)){
            $att2    = $path.$request->assetcode."-att2-".$request->regatt2->getClientOriginalName();
            $request->regatt2->move($destinationAtt,$att2);
            $upload_date = NOW()->format('Y-m-d');

            $data += [
                "att2"          => $att2,
                "upload_date"       => $upload_date,
            ];

        }else{
            $att2 = 'default-att.pdf';
        }

        if(!empty($request->regatt3)){
            $att3    = $path.$request->assetcode."-att3-".$request->regatt3->getClientOriginalName();
            $request->regatt3->move($destinationAtt,$att3);
            $upload_date = NOW()->format('Y-m-d');

            $data += [
                "att3"          => $att3,
                "upload_date"       => $upload_date,
            ];
        }else{
            $att3 = 'default-att.pdf';
        }

        if($img){
            $img->save($destinationPath.$imgname,100);
            $upload_date = NOW()->format('Y-m-d');

            $data += [
                "filename"          => $path.$imgname,
                "upload_date"       => $upload_date,
            ];

        }else{
            $upload_date = null;
            // return response()->json(['message'=>'Gagal menyimpan gambar.'],422);
        }
        /* END UPLOAD IMAGE AND FILE */
        
        $after = $data;

        $update = Asset::where('asset_id',$request->id)->update($data);

        if($update){
            
            $data_audit = [
                "ChangedDateandTime" =>date('d-m-Y H:i:s'),
                "UserID" => Auth::user()->name,
                "Action_Activity" => "Updated Asset Register",
                "Asset_ID" => $request->id,
                "Module_Feature" => "Asset Register",
                "OldValue_Remark" => $before,
                "NewValue_Remark" => $after,
            ];

            $audit = Audit::firstOrCreate(['Asset_ID'=>$request->id,"UserID" => Auth::user()->name,'Action_Activity'=> 'Updated Asset Register'],$data_audit);
            
            if(!empty($audit->Asset_ID)){
                $audit->update($data_audit);
            }

            return response()->json(['message'=>'Berhasil mengubah data!'],200);
        }else{
            return response()->json(['message'=>'Gagal mengubah data','errors' => $update],422);
        }
    }

    public function destroy($id)
    {
        $Asset = Asset::find($id);

        $destinationImg = public_path('assets/images/');

        $destinationAtt = public_path('assets/attachment/');
      
        if(file_exists($destinationAtt.$Asset->att1)){     
            unlink($destinationAtt.$Asset->att1);
        }

        if(file_exists($destinationAtt.$Asset->att2)){     
            unlink($destinationAtt.$Asset->att2);
        }

        if(file_exists($destinationAtt.$Asset->att3)){     
            unlink($destinationAtt.$Asset->att3);
        }

        if(file_exists($destinationImg.$Asset->filename)){     
            unlink($destinationImg.$Asset->filename);
        }

        $Asset = $Asset->delete();

        if($Asset){
            return response()->json(['message'=>'Berhasil menghapus data terkait.'],200);
        }else{
            return response()->json(['message'=>'Gagal menghapus data terkait.'],422);
        }
    }
}
