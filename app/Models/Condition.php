<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
    protected $table = 'db_condition';

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $fillable = [
        'conditioncode',
        'conditiondesc',
        'cloud_id',
        'rbo_user',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;
}
