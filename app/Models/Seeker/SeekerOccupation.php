<?php

namespace App\Models\Seeker;

use App\Models\OccupationSubtypes;
use Illuminate\Database\Eloquent\Model;

class SeekerOccupation extends Model
{
    protected $table = 'seeker_occupations';
    protected $templatePath = 'public/pages';
    protected $contentId = 'page';

    protected $fillable = [
        'profile_id',
        'occupation_subtype_id',
        'years'
    ];
    protected $appends = array('allTypes');

    public function getallTypesAttribute($id)
    {
        return OccupationSubtypes::where('occupation_id', $id)->get();
    }
}
