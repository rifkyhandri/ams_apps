<?php

namespace App\Models;
use App\Models\Account_sub;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account_Group extends Model
{
    protected $table = 'db_account_group';
    protected $fillable = [
        'id_account_group',
        'account_group_name'
    ];
    

    public function account_sub(){
        return $this->hasMany(Account_sub::class,'id_db_account_group','id_account_group');
    }
}
