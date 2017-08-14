<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;

class JobAddresses extends Model
{
    protected $table = 'job_addresses';
    protected $templatePath = 'public/pages';
    protected $contentId = 'page';

    protected $fillable = [
        'job_id',
        'country_id',
        'zip'
    ];
}
