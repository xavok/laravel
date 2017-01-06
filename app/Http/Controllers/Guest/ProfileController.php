<?php

namespace App\Http\Controllers\Guest;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{

    public function index()
    {
        if(Auth::check()) {
            $user = Auth::user();
            return view('public.pages.seeker-portal', ['user' => $user]);
        } else {
            return view('public.pages.homepage');
        }
    }
}
