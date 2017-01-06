<?php
/**
 * Created by PhpStorm.
 * User: Xavok
 * Date: 1/5/2017
 * Time: 9:58 PM
 */

namespace App\Models;


class Countries extends Content
{
    protected $table = 'countries';

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
    ];

    public function countryCodes() {
        $this->select('iso_3166_3');
    }
}