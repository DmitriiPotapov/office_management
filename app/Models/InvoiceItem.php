<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $fillable = [
        'invoice_id',
        'type',
        'text',
        'price',
        'VAT',
        'disaccount',
        'total_price',
        'merge',
    ];
}
