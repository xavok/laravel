<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationLevel extends Content
{
    protected $table = 'education_levels';

    protected $fillable = [
        'name',
    ];

}
