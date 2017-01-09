<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OccupationSubtypes extends Model
{
    protected $table = 'occupation_subtypes';
    protected $fillable = [
        'occupation_id',
        'occupation_subtype_name'
    ];


}
