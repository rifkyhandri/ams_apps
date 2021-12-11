<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostCenter extends Model
{
    protected $table = 'db_costcenter';

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $fillable = [
        'costcentercode',
        'costcenterdesc',
        'bookvalrate',
        'cloud_id',
        'coa',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;
}
