<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phones extends Content
{
    protected $table = 'phones';

    protected $fillable = [
        'user_id',
        'phone_number'
    ];

}
