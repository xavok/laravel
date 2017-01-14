<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preferences extends Content
{
    protected $table = 'preferences';

    protected $fillable = [
        'slug',
        'description'
    ];

    public function choices()
    {
        return $this->hasMany('App\Models\PreferenceChoices', 'preference_id');
    }

}
