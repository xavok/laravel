<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Addresses extends Content
{
    protected $table = 'addresses';

    protected $fillable = [
        'country_id',
        'profile_id',
        'zip'
    ];

}
