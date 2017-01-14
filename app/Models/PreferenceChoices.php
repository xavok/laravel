<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreferenceChoices extends Content
{
    protected $table = 'preference_choices';

    protected $fillable = [
        'preference_id',
        'rank',
        'description'
    ];

}
