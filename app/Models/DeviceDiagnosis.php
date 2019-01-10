<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceDiagnosis extends Model
{
    protected $fillable = [
        'device_name',
        'device_type'
    ];
}
