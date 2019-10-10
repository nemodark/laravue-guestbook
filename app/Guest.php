<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone_number',
        'gender',
        'address',
        'country_code'
    ];

    
}
