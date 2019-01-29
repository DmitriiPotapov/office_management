<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable =[
        'invoice_id',
        'job_id',
        'client_name',
        'invoice_language',
        'currency',
        'item_type',
        'item_capacity',
        'item_price',
        'item_vat',
        'item_disaccount',
        'item_total_price',
        'invoice_note',
        'status',
        'created_by',       
    ];
}
