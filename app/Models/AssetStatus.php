<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetStatus extends Model
{
    protected $table = 'db_statusasset';

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $fillable = [
        'id_statusasset',
        'description',
        'tree_id',
        'time_login',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;
}
