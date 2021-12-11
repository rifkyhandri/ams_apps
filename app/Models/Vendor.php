<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = 'db_vendor';

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $fillable = [
        'vendorcode',
        'vendorname',
        'account',
        'OpeningDate',
        'address',
        'city',
        'postal',
        'phone',
        'fax',
        'telex',
        'status',
        'cloud_id',
        'pic',
        'pic_phone',
        'pic_email',
        'tree_id',
        'acc40',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;
}
