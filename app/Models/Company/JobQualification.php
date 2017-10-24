<?php

namespace App\Models\Company;

use App\Models\OccupationSubtypes;
use Illuminate\Database\Eloquent\Model;

class JobQualification extends Model
{
    protected $table = 'job_qualifications';
    protected $templatePath = 'public/pages';
    protected $contentId = 'page';

    protected $fillable = [
        'job_id',
        'qualification_id',
        'qualification_rank'
    ];
}
