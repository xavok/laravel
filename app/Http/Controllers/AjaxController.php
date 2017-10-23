<?php

namespace App\Http\Controllers;

use App\Models\OccupationSubtypes;
use App\Models\Seeker\SeekerPreferences;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Validator;

use App\Http\Requests;

class AjaxController extends Controller
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
            return response()->json(['success' => false,'validator' => false]);
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
                    return response()->json(['success' => true, 'commandType' => true]);
                } else {
                    return response()->json(['success' => true]);
                }
            } else {
                // validation not successful, send back to form
                return response()->json(['success' => false,'notFound' => true]);
            }

        }
    }

    //
    public function occupationTypes(Request $request, $id){
        $types = OccupationSubtypes::where('occupation_id',$id)->get();
        return response()->json($types);
    }

    public function culturalChoices(Request $request, $profile_id) {
        return response()->json(SeekerPreferences::where('profile_id', $profile_id)->first());
    }
}
