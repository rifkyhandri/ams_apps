<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Departement;

class Asset extends Model
{
    protected $table = 'db_asset';

    protected $primaryKey = 'asset_id';

    public $incrementing = true;

    protected $columns = [
        'old_tagnumber',
        "tangnumber",
        "assetname",
        "asset_type",
        "models",
        "notes",
        "assetclass",
        "custodian",
        "assetgroup",
        "costcenter",
        "asCondition",
        "location",
        "departement",
        "vendors",
        'account',
        "payment",
        "serial",
        "datepurchase",
        "dateacq",
        "purchasecost",
        "purchaseacq",
        "lifetimeyear",
        "livetimemonth",
        "comdepreciation",
        "fiscaldepreciation",
        "salvage1",
        "bookrate",
        "serviceprovider",
        "nextservice",
        "warranty",
        "servicecontract",
        "tagged",
        "brand",
        "manufacture",
        "partnumber",
        "ownership",
        "ESN",
        "IP",
        "asstatus",
        "gps_lat",
        "gps_long",
        "att1",
        "att2",
        "att3",
        "filename",
        'created_at',
        'updated_at'
    ];

    public $fillable = [
        'old_tagnumber',
        "tangnumber",
        "assetname",
        "asset_type",
        "models",
        "notes",
        "assetclass",
        "custodian",
        "assetgroup",
        "costcenter",
        "asCondition",
        "location",
        "departement",
        "vendors",
        'account',
        "payment",
        "serial",
        "datepurchase",
        "dateacq",
        "purchasecost",
        "purchaseacq",
        "lifetimeyear",
        "livetimemonth",
        "comdepreciation",
        "fiscaldepreciation",
        "salvage1",
        "bookrate",
        "serviceprovider",
        "nextservice",
        "warranty",
        "servicecontract",
        "tagged",
        "brand",
        "manufacture",
        "partnumber",
        "ownership",
        "ESN",
        "IP",
        "asstatus",
        "gps_lat",
        "gps_long",
        "att1",
        "att2",
        "att3",
        "filename",
        "last_trasactions",
        "stock_opname",
        "created_at",
        "updated_at"
    ];

    public $timestamps = true;

    public function scopeExclude($query, $value = []) 
    {
        return $query->select(array_diff($this->columns, (array) $value));
    }

    public function objdepartement()
    {
        return $this->belongsTo(Departement::class, 'departement', 'departementcode');
    }

    public function objcostgroup()
    {
        return $this->belongsTo(CostGroup::class, 'assetgroup', 'groupcode');
    }

    public function objlocation()
    {
        return $this->belongsTo(Location_sm::class, 'location', 'locationcode_sm');
    }
    public function location_sm()
    {
        return $this->belongsTo(Location_sm::class, 'location', 'locationcode_sm');
    }
    
    public function objcostcenter()
    {
        return $this->belongsTo(CostCenter::class, 'costcenter', 'costcentercode');
    }

    public function objcustodian()
    {
        return $this->belongsTo(Custodian::class, 'custodian', 'custodiancode');
    }

    public function objassetclass()
    {
        return $this->belongsTo(AssetClass::class, 'assetclass', 'classcode');
    }

    public function objcondition()
    {
        return $this->belongsTo(Condition::class, 'asCondition', 'conditioncode');
    }

    public function objvendor()
    {
        return $this->belongsTo(Vendor::class, 'vendors', 'vendorcode');
    }
    
    public function objaccount()
    {
        return $this->belongsTo(AccountChart::class, 'account', 'accountno');
    }

    public function objprovider()
    {
        return $this->belongsTo(Provider::class, 'serviceprovider', 'providercode');
    }

    public function objowner()
    {
        return $this->belongsTo(Ownership::class, 'ownership', 'id_ownership');
    }

    public function objassettype()
    {
        return $this->belongsTo(AssetType::class, 'asset_type', 'id_typeasset');
    }

    public function objassetstatus()
    {
        return $this->belongsTo(AssetStatus::class, 'asstatus', 'id_statusasset');
    }
}