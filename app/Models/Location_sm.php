<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location_sm extends Model
{
    protected $table = 'db_location_sm';

    protected $fillable = [
        'locationcode_big',
        'locationcode_sub',
        'locationcode_sm',
        'locationname_sm',
        'contact',
        'address_sm',
        'city',
        'postal',
        'phone',
        'fax',
        'OpeningDate'
    ];

    public function location_sub(){
        return $this->belongsTo(Location_sub::class,'locationcode_sub','id');
    }

    public function location_big(){
        return $this->belongsTo(Location::class,'locationcode_big','id');
    }
}
