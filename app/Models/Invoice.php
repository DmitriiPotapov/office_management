<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable =[
        'job_id',
        'client_id',
        'client_name',
        'invoice_language',
        'currency',
        'footer_text',
        'invoice_note',
        'status',
        'created_by',       
    ];
}
