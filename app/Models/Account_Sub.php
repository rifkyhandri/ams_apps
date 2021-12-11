<?php

namespace App\Models;
use App\Models\Account_Group;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account_Sub extends Model
{
   protected $table = 'db_account_sub';
   protected $fillable = 
   [
       'id_db_account_group',
       'id_account_sub',
       'account_sub_name',
   ];
   public function account_group(){
       return $this->belongsTo(Account_Group::class,'id_db_account_group','id_account_group');
   }
}
