<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'client_name',
        'street',
        'postal_code',
        'country',
        'ui_language',
        'email_value',
        'email_name',
        'phone_value',
        'phone_name',
        'client_note',
        'client_group',
        'company'
    ];
}
