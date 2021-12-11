<?php

namespace App\Imports;

use App\Models\Asset;
use App\Models\AssetClass;
use App\Models\AssetStatus;
use App\Models\AssetType;
use App\Models\AccountChart;
use App\Models\Custodian;
use App\Models\CostGroup;
use App\Models\CostCenter;
use App\Models\Condition;
use App\Models\Departement;
use App\Models\Location_sm;
use App\Models\Ownership;
use App\Models\Provider;
use App\Models\Vendor;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithUpserts;

class AssetImport implements ToModel,WithHeadingRow,WithChunkReading,WithBatchInserts,WithUpserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Asset([
            "tangnumber"         => $row["asset_code"],
            "assetname"          => $row["asset_name"],
            "assetclass"         => (!empty($class = AssetClass::select('classcode')->where('classdesc',$row["asset_class"])->firstOr(function () {
                                        return null;
                                    })) ? $class->classcode: null ),
            "custodian"          => (!empty($custodian = Custodian::select('custodiancode')->where('custodianname',$row["custodian"])->firstOr(function () {
                                        return null;
                                    })) ? $custodian->custodiancode: null ),
            "departement"        => (!empty($departement = Departement::select('departementcode')->where('departementdesc',$row["departement"])->firstOr(function () {
                                        return null;
                                    })) ? $departement->departementcode: null ),
            "assetgroup"         => (!empty($costgroup = CostGroup::select('groupcode')->where('groupname',$row["cost_group"])->firstOr(function () {
                                        return null;
                                    })) ? $costgroup->groupcode: null ),
            "location"           => (!empty($location_sm = Location_sm::select('locationcode_sm')->where('locationname_sm',$row["location"])->firstOr(function () {
                                    return null;
                                    })) ? $location_sm->locationcode_sm: null ),
            "costcenter"         => (!empty($cost_center = CostCenter::select('costcentercode')->where('costcenterdesc',$row["cost_center"])->firstOr(function () {
                                    return null;
                                    })) ? $cost_center->costcentercode: null ),
            "vendors"            => (!empty($vendor = Vendor::select('vendorcode')->where('vendorname',$row["vendor"])->firstOr(function () {
                                    return null;
                                    })) ? $vendor->vendorcode: null ),
            "models"             => $row["model"],
            "asCondition"        => (!empty($condition = Condition::select('conditioncode')->where('conditiondesc',$row["condition"])->firstOr(function () {
                                    return null;
                                    })) ? $condition->conditioncode: null ),
            "notes"              => $row["notes"],
            "payment"            => $row["po_number"],
            "serial"             => $row["snlicense_plate"],
            'account'            => (!empty($account = AccountChart::select('accountno')->where('accountname',$row["account_number"])->firstOr(function () {
                                    return null;
                                    })) ? $account->accountno: null ),
            "datepurchase"       => $row["purchase_date"],
            "dateacq"            => $row["acq_date"],
            "purchasecost"       => $row["purchase_cost"],
            "purchaseacq"        => $row["acq_cost"],
            "lifetimeyear"       => $row["year"],
            "livetimemonth"      => $row["month"],
            "comdepreciation"    => $row["depreciation_method"],
            "fiscaldepreciation" => $row["depreciation_method"],
            "salvage1"           => $row["salvage"],
            "bookrate"           => $row["depr_rate"],
            "serviceprovider"    => (!empty($provider = Provider::select('providercode')->where('providername',$row["service_provider"])->firstOr(function () {
                                    return null;
                                    })) ? $provider->providercode: null ),
            "nextservice"        => $row["next_service"],
            "warranty"           => $row["warranty"],
            "servicecontract"    => $row["contract_no"],
            "tagged"             => $row["tagging"],
            "brand"              => $row["brand"],
            "manufacture"        => $row["manufacture"],
            "ESN"                => $row["esn"],
            "partnumber"         => $row["part_number"],
            "ownership"          => (!empty($owner = Ownership::select('id_ownership')->where('description',$row["ownership"])->firstOr(function () {
                                    return null;
                                    })) ? $owner->id_ownership: null ),
            "asset_type"         => (!empty($asset_type = AssetType::select('id_typeasset')->where('description',$row["type"])->firstOr(function () {
                                    return null;
                                    })) ? $asset_type->id_typeasset: null ),
            "IP"                 => $row["ip_address"],
            "asstatus"           => (!empty($status = AssetStatus::select('id_statusasset')->where('description',$row["status"])->firstOr(function () {
                                    return null;
                                    })) ? $status->id_statusasset: null ),
            "gps_lat"            => $row["latitude"],
            "gps_long"           => $row["longitude"],
            "filename"           => $row["image_path"],
            "att1"               => $row["att1"],
            "att2"               => $row["att2"],
            "att3"               => $row["att3"],
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }
    
    public function chunkSize(): int
    {
        return 1000; //ANGKA TERSEBUT PERTANDA JUMLAH BARIS YANG AKAN DIEKSEKUSI
    }

    public function uniqueBy()
    {
        return 'tangnumber';
    }
}
