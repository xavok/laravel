<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Content
{
    protected $table = 'users';
    protected $templatePath = 'public/pages';
    protected $contentId = 'page';
    const USER_ADMIN = 'admin';
    const USER_SEEKER = 'seeker';
    const USER_COMPANY = 'company';
    protected $fillable = [
        'email',
        'password',
    ];
}
