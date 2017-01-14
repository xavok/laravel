<?php

namespace App\Models\Seeker;

use Illuminate\Database\Eloquent\Model;

class SeekerEducation extends Model
{
    protected $table = 'seeker_education';
    protected $templatePath = 'public/pages';
    protected $contentId = 'page';
    //    protected $appends = ['identifier', 'callouts', 'videos', 'carousels'];

    protected $fillable = [
        'profile_id',
        'school',
        'education_level_id',
        'study_field_id',
        'graduation_date'
    ];
}
