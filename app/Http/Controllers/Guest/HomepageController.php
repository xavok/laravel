<?php

namespace App\Http\Controllers\Guest;

use App\Models\Users;
use App\Http\Controllers\Controller;
use App\User;

class HomepageController extends Controller
{
    public function index()
    {
        return view('public.pages.homepage');
    }

    public function login()
    {
        $users = Users::all();
        return var_dump($users);
    }
}
