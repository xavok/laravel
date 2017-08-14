<?php

namespace App\Http\Controllers\Guest;

use App\Models\Company\Companies;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Models\Seeker\SeekerProfile;

class HomepageController extends Controller
{

    public function index()
    {
        return view('public.pages.homepage');
    }

    public function login(Request $request)
    {
        // validate the info, create rules for the inputs
        $rules = array(
            'email' => 'required|email', // make sure the email is an actual email
            'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
        );
        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);
        // if the validator fails, redirect back to homepage
        if ($validator->fails()) {
            return Redirect::to('/')
                ->withErrors($validator)// send back all errors to the login form
                ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
        } else {
            // create our user data for the authentication
            $userdata = array(
                'email' => Input::get('email'),
                'password' => Input::get('password')
            );
            // attempt to do the login
            if (Auth::attempt($userdata)) {
                $user = Auth::user();
                if($user['type'] === Users::USER_COMPANY) {
                    return Redirect::route('guest::command-center');
                } else {
                    return Redirect::to('/profile');
                }
            } else {
                // validation not successful, send back to form
                return Redirect::to('/')
                    ->withErrors(['Username/password is incorrect. Please try again']);
            }

        }
    }

    public function logout()
    {
        Auth::logout(); // log the user out of our application
        return Redirect::to('/'); // redirect the user to the login screen
    }

    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            // validate the info, create rules for the inputs
            $rules = array(
                'email' => 'required|email', // make sure the email is an actual email
                'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
            );
            // run the validation rules on the inputs from the form
            $validator = Validator::make(Input::all(), $rules);
            // if the validator fails, redirect back to homepage
            if ($validator->fails()) {
                return Redirect::to('/')
                    ->withErrors($validator)// send back all errors to the login form
                    ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
            } else {
                //adding user
                $user = new Users();
                $email = $request->get('email');
                $password = $request->get('password');
                $user->email = $email;
                $user->password = Hash::make($password);
                $user->type = Users::USER_SEEKER;
                $user->save();
                Auth::attempt(['email' => $email, 'password' => $password]);

                //adding seeker profile for user
                $profile = new SeekerProfile();
                $profile->user_id = $user->id;
                $profile->first_name = $request->get('first_name');
                $profile->last_name = $request->get('last_name');
                $profile->last_matched = Carbon::now();
                $profile->should_be_matched = 0;
                $profile->save();
                return Redirect::route('guest::onboarding::about-you', ['page' => 'about-you']);

            }
        } else {
            return view('public.pages.register');
        }
    }


}
