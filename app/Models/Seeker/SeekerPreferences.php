<?php

namespace App\Models\Seeker;

use Illuminate\Database\Eloquent\Model;

class SeekerPreferences extends Model
{
    protected $table = 'seeker_preferences';
    protected $templatePath = 'public/pages';
    protected $contentId = 'page';

    protected $fillable = [
        'id',
        'profile_id',
        'workplace_1_id',
        'workplace_2_id',
        'workplace_3_id',
        'atmosphere_1_id',
        'atmosphere_2_id',
        'atmosphere_3_id',
        'workenvironment_1_id',
        'workenvironment_2_id',
        'workenvironment_3_id',
        'interaction_1_id',
        'interaction_2_id',
        'interaction_3_id',
        'microculture_1_id',
        'microculture_2_id',
        'microculture_3_id'
    ];
}
