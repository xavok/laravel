<?php

namespace App\Models\Seeker;

use Illuminate\Database\Eloquent\Model;

class SeekerIndustry extends Model
{
    protected $table = 'seeker_industries';
    protected $templatePath = 'public/pages';
    protected $contentId = 'page';
    //    protected $appends = ['identifier', 'callouts', 'videos', 'carousels'];

    protected $fillable = [
        'profile_id',
        'industy_id',
        'years'
    ];
}
