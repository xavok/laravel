<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Content
{
    protected $table = 'users';
    protected $templatePath = 'public/pages';
    protected $contentId = 'page';
//    protected $appends = ['identifier', 'callouts', 'videos', 'carousels'];

    protected $fillable = [
        'email',
        'password',
    ];
}
