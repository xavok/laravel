<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;

class JobEducation extends Model
{
    protected $table = 'job_educations';
    protected $templatePath = 'public/pages';
    protected $contentId = 'page';
    //    protected $appends = ['identifier', 'callouts', 'videos', 'carousels'];

    protected $fillable = [
        'job_id',
        'education_level_id',
        'study_field_id',
    ];
}
