<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;

class JobInfo extends Model
{
    protected $table = 'job_info';
    protected $templatePath = 'public/pages';
    protected $contentId = 'page';
    //    protected $appends = ['identifier', 'callouts', 'videos', 'carousels'];

    protected $fillable = [
        'job_id',
        'name',
        'description'
    ];
}
