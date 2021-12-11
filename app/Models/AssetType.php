<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetType extends Model
{
    protected $table = 'db_typeasset';

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $fillable = [
        'id_typeasset',
        'description',
        'tree_id',
        'cloud_id',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;
}
