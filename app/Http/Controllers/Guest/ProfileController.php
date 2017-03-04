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
use App\Models\Seeker\SeekerProfile;

class ProfileController extends Controller
{

    public function index()
    {
        if(Auth::check()) {
            $user_id = Auth::user()->id;
            $profile = SeekerProfile::where('user_id', $user_id)->first();
            return view('public.pages.seeker-portal', ['user' => $profile]);
        } else {
            return view('public.pages.homepage');
        }
    }
}
