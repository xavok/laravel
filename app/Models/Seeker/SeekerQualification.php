<?php

namespace App\Models\Seeker;

use App\Models\OccupationSubtypes;
use Illuminate\Database\Eloquent\Model;

class SeekerQualification extends Model
{
    protected $table = 'seeker_qualifications';
    protected $templatePath = 'public/pages';
    protected $contentId = 'page';

    protected $fillable = [
        'profile_id',
        'qualification_id',
        'qualification_rank'
    ];
}
