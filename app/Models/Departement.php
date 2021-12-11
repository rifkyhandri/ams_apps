<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Asset;

class Departement extends Model
{
    protected $table = 'db_departement';

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $fillable = [
        'departementcode',
        'departementdesc',
        'tree_id',
        'cloud_id',
        'book_value',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;

    public function asset()
    {
        return $this->hasMany(Asset::class, 'departementcode', 'departement');
    }
}
