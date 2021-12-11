<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location_sub extends Model
{
   
   protected $table = 'db_location_sub';

   protected $fillable = [
      'locationcode_big',
      'locationcode_sub',
      'locationname_sub',
      'contact',
      'address',
      'city',
      'postal',
      'phone',
      'OpeningDate',
      'fax'
   ];

   public function location(){
      return $this->belongsTo(Location::class,'locationcode_big','id');
   }

   public function location_sm(){
      return $this->hasMany(Location_sm::class,'locationcode_sub','id');
   }
}
