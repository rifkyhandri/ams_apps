<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Asset;

class Asset_transaction extends Model
{
    protected $table = 'db_asset_transaction';
    
    protected $primaryKey = 'id_asset_transaction';
    
    public $incrementing = true;
    
    public $fillable = ['id_asset_transaction',
        'asset_id',
        'tangnumber',
        'new_tangnumber',
        'transaction_name',
        'transaction_date',
        'wd_value',
        'sale_ammount',
        'diff_total',
        'transfer_account',
        'revaluation_value',
        'revaluation_salvage',
        'extend_year',
        'extend_month',
        'change_location',
        'change_costcenter',
        'change_custodian',
        'change_assetclass',
        'change_condition',
        'change_tagged',
        'change_stock_opname',
        'requester',
        'approver',
        'approval',
        'created_at'
    ]; 
    
    protected $columns = [
        'asset_id',
        'tangnumber',
        'new_tangnumber',
        'transaction_name',
        'transaction_date',
        'wd_value',
        'sale_ammont',
        'diff_total',
        'transfer_account',
        'revaluation_value',
        'revaluation_salvage',
        'extend_year',
        'extend_month',
        'change_location',
        'change_costcenter',
        'change_custodian',
        'change_assetclass',
        'change_condition',
        'change_tagged',
        'change_stock_opname',
        'requester',
        'approver',
        'approval',
        'created_at'
    ];

    public $timestamps = true;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'transaction_date' => 'datetime:Y-m-d'
    ];

    public function approveasset()
    {
        return $this->belongsTo(Asset::class, 'asset_id', 'asset_id');
    }

    public function approveassetclass()
    {
        return $this->belongsTo(AssetClass::class, 'change_assetclass', 'classcode');
    }

    public function approvecondition()
    {
        return $this->belongsTo(Condition::class, 'change_condition', 'conditioncode');
    }

    public function approveaccount()
    {
        return $this->belongsTo(AccountChart::class,'transfer_account','accountno');
    }

    public function approvelocation()
    {
        return $this->belongsTo(Location_sm::class,'change_location','locationcode_sm');
    }

    public function approvecustodian()
    {
        return $this->belongsTo(Custodian::class,'change_custodian','custodiancode');
    }

    public function approvecostcenter()
    {
        return $this->belongsTo(CostCenter::class,'change_costcenter','costcentercode');
    }
  

}
