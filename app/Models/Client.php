<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'client_name',
        'pib_jmbg',
        'street',
        'number',
        'apt',
        'postal_code',
        'pak',
        'city_name',
        'country',
        'ui_language',
        'email_value',
        'email_name',
        'phone_value',
        'phone_name',
        'client_note'
    ];
}
