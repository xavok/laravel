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
                return Redirect::route('guest::command-center');

            }
        } else {
            return view('public.pages.company.register');
        }
    }

    public function commandCenter(Request $r) {
        if(Auth::check()) {
            $user_id = Auth::user()->id;
            $company = Companies::where('user_id', $user_id)->first();
            return view('public.pages.company.command-center', ['company' => $company]);
        } else {
            return view('public.pages.homepage');
        }
    }
}
