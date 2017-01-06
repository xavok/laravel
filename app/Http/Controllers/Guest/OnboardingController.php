<?php
/**
 * Created by PhpStorm.
 * User: Xavok
 * Date: 1/5/2017
 * Time: 9:27 PM
 */

namespace App\Http\Controllers\Guest;

use App\Models\Countries;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;


class OnboardingController extends Controller
{

    public function index(Request $request, $form)
    {
        if(Auth::check()) {
            $user = Auth::user();
            $countries = Countries::all();
            return view('public.pages.forms.' . $form, [
                'user' => $user,
            'countries' =>$countries]);
        } else {
            return view('public.pages.homepage');
        }
    }
}
