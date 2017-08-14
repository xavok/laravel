<?php

namespace App\Http\Controllers\Guest;

use App\Models\Company\Companies;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class CompanyController extends Controller
{

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

                return Redirect::to('/profile');
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
                $user->type = Users::USER_COMPANY;
                $user->save();
                Auth::attempt(['email' => $email, 'password' => $password]);

                //adding seeker profile for user
                $company = new Companies();
                $company->user_id = $user->id;
                $company->name = $request->get('name');
                $company->save();
                return Redirect::route('guest::onboarding::about-you', array('page' => 'about-you'));

            }
        } else {
            return view('public.pages.company.register');
        }
    }

    public function commandCenter(Request $r) {
        if(Auth::check()) {
            $user_id = Auth::user()->id;
            return view('public.pages.company.command-center');
        } else {
            return view('public.pages.homepage');
        }
    }
}
