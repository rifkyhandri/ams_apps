<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $table = 'db_provider';

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $fillable = [
        'providercode',
        'providername',
        'contact',
        'address',
        'OpeningDate',
        'city',
        'postal',
        'phone',
        'fax',
        'telex',
        'cloud_id',
        'tree_id',
        'pr40',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;
}
