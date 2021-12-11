<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostGroup extends Model
{
    protected $table = 'db_assetgroup';

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $fillable = [
        'groupcode',
        'groupname',
        'bookvalrate',
        'life',
        'Building',
        'Ledger1',
        'Ledger2',
        'Ledger3',
        'Ledger4',
        'Ledger5',
        'Ledger6',
        'Ledger7',
        'bookdepreciation',
        'bookdeptrate',
        'taxdepreciation',
        'taxdeprate',
        'cloud_id',
        'qty',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;
}
