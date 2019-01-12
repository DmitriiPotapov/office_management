<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockItem extends Model
{
    protected $fillable = [
        'device_type',
        'connection',
        'form_factor',
        'manufacturer',
        'stock_model',
        'location',
        'diler_info',
        'serial_number',
        'input_price',
        'vat_value',
        'interest',
        'final_price',
        'stock_note'
    ];
}
