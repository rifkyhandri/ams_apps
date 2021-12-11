<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountChart extends Model
{
    protected $table = 'db_account';

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $fillable = [
        'accountno',
        'accountname',
        'accountshortname',
        'accountgroup',
        'oldaccount',
        'subgroup',
        'level',
        'status',
       
    ];

    public $timestamps = true;
}
