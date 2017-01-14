<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preferences extends Content
{
    protected $table = 'preferences';

    protected $fillable = [
        'description'
    ];

}
