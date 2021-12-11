<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ownership extends Model
{
    protected $table = 'db_ownership';

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $fillable = [
        'id_ownership',
        'description',
        'tree_id',
        'keterangan',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;
}
