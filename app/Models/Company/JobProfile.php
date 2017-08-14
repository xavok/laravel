<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;

class JobProfile extends Model
{
    protected $table = 'job_profiles';
    protected $templatePath = 'public/pages';
    protected $contentId = 'page';
    //    protected $appends = ['identifier', 'callouts', 'videos', 'carousels'];

    protected $fillable = [
        'company_id',
        'last_matched',
        'should_be_matched'
    ];
}
