<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Location_sub;

class Location extends Model
{
    protected $table = 'db_location';

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $fillable = [
        'locationcode',
        'locationname',
        'contact',
        'OpeningDate',
        'country',
        'postal',
        'phone',
        'fax',
        'address'
    ];

    public $timestamps = true;

    public function location_sub(){
        return $this->hasMany(Location_sub::class,'locationcode_big','id');
    }
    public function location_sm(){
        return $this->belongsTo(Location_sm::class,'locationcode_big','id');
    }
    public function location_subz(){
        return $this->belongsTo(Location_sub::class,'locationcode_sub','id');
    }
    public function asset(){
        return $this->hasMany(Asset::class,'location','id');
    }
}
