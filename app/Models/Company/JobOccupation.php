<?php

namespace App\Models\Company;

use App\Models\OccupationSubtypes;
use Illuminate\Database\Eloquent\Model;

class JobOccupation extends Model
{
    protected $table = 'job_occupations';
    protected $templatePath = 'public/pages';
    protected $contentId = 'page';

    protected $fillable = [
        'job_id',
        'occupation_id',
        'occupation_subtype_id',
        'years'
    ];
    protected $appends = array('allTypes');

    public function getallTypesAttribute($id)
    {
        return OccupationSubtypes::where('occupation_id', $id)->get();
    }
}
