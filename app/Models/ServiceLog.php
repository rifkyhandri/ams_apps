<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceLog extends Model
{
    protected $table = 'db_servicelog';

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $fillable = [
            'tangnumber',
            'providercode',
            'notes',
            'servicedate',
            'servicecontract',
            'nextservice',
            'costservice',
            'created_at',
            'updated_at'
    ];

    public function asset(){
        return $this->belongsTo(Asset::class,'tangnumber','tangnumber');
    }
}
