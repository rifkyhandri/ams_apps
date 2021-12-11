<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    use HasFactory;
    
    protected $table = 'auditrail';

    protected $fillable = [
        'ChangedDateandTime',
        'UserID',
        'Action_Activity',
        'Asset_ID',
        'Module_Feature',
        'Field_Name',
        'OldValue_Remark',
        'NewValue_Remark',
        'Other1'
    ];

    protected $casts = [
        'OldValue_Remark' => 'array',
        'NewValue_Remark' => 'array',
    ];

    public $timestamps = false;

    public function getOldValue_RemarkAttribute($value)
    {
        return json_decode($value);
    }

    public function getNewValue_RemarkAttribute($value)
    {
        return json_decode($value);
    }
}
