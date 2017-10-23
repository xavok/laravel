<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;

class JobIndustry extends Model
{
    protected $table = 'job_industries';
    protected $templatePath = 'public/pages';
    protected $contentId = 'page';

    protected $fillable = [
        'job_id',
        'industry_id',
        'years'
    ];
}
