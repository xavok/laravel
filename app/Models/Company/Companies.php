<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    protected $table = 'companies';
    protected $templatePath = 'public/pages';
    protected $contentId = 'page';

    protected $fillable = [
        'name',
        'user_id',
        'level'
    ];


}
