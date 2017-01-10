<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudyField extends Content
{
    protected $table = 'study_fields';

    protected $fillable = [
        'name',
    ];

}
