<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Occupations extends Model
{
    protected $table = 'occupations';
    protected $fillable = [
        'occupation_name'
    ];

    public function occupation_subtype()
    {
        return $this->hasOne('App\Models\OccupationSubtypes', 'occupation_id');
    }
}
