<?php

namespace App\Models\Seeker;

use Illuminate\Database\Eloquent\Model;

class SeekerProfile extends Model
{
    protected $table = 'seeker_profiles';
    protected $templatePath = 'public/pages';
    protected $contentId = 'page';
    //    protected $appends = ['identifier', 'callouts', 'videos', 'carousels'];

    protected $fillable = [
        'first_name',
        'last_name',
        'user_id',
        'last_matched',
        'should_be_matched'
    ];

    public function address()
    {
        return $this->hasOne('App\Models\Addresses', 'profile_id');
    }
    public function phone()
    {
        return $this->hasOne('App\Models\Phones', 'profile_id');
    }
}
