<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetClass extends Model
{
    protected $table = 'db_assetclass';

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $fillable = [
        'classcode',
        'classdesc',
        'tree_id',
        'cloud_id',
        'book_value',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;
}
