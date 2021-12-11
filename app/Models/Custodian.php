<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Custodian extends Model
{
    protected $table = 'db_custodian';

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $fillable = [
        'custodiancode',
        'custodianname',
        'contact',
        'address',
        'OpeningDate',
        'phone',
        'city',
        'postal',
        'fax',
        'telex',
        'cloud_id',
        'email',
        'usertype',
        'company',
        'tree_id',
        'status',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;
}
