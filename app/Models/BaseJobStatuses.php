<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseJobStatuses extends Model
{
    //
    protected $table = "base_job_statuses";

    protected $fillable = [
        'status_name', 
    ];
}
