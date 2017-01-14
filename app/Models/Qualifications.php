<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Qualifications extends Model
{
    //
    protected $table = 'qualifications';

    protected $fillable = [
        'name',
        'description'
    ];
}
