<?php
/**
 * Created by PhpStorm.
 * User: Xavok
 * Date: 1/5/2017
 * Time: 9:27 PM
 */

namespace App\Http\Controllers\Guest;

use App\Models\Addresses;
use App\Models\Countries;
use App\Models\Phones;
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

    public function index(Request $request)
    {
        if (Auth::check()) {
            if ($request->isMethod('post')) {
                $user_id = Auth::user()->id;
                $country_id = $request->get('country_id');
                $zip = $request->get('zip');
                $phone_number = $request->get('phone');
                $user = Users::findOrFail($user_id);
                $user->first_name = $request->get('first_name');
                $user->last_name = $request->get('last_name');
                $user->save();
                $address = Addresses::where('user_id', $user_id)->first();
                if($address->count()) {
                    $address->country_id = $country_id;
                    $address->zip = $zip;
                } else {
                    $address = new Addresses();
                    $address->country_id = $country_id;
                    $address->zip = $zip;
                    $address->user_id=$user_id;
                }
                $address->save();

                $phone = Phones::where('user_id', $user_id)->first();
                if($phone->count()) {
                    $phone->phone_number = $phone_number;
                } else {
                    $phone = new Phones();
                    $phone->phone_number = $phone_number;
                    $phone->user_id =$user_id;
                }
                $phone->save();

                return Redirect::route('guest::onboarding::occupation', array('page' => 'occupation'));
            } else {
                $user = Users::findOrFail(Auth::user()->id);
                $countries = Countries::orderByRaw("id='840' desc")->get();
                $address = $user->address;
                $phone = $user->phone;
                return view('public.pages.preferences', [
                    'user' => $user,
                    'countries' => $countries,
                    'address' => $address,
                    'phone' => $phone,
                    'page'=> 'about-you'
                ]);
            }
        } else {
            return view('public.pages.homepage');
        }
    }

    public function occupation(Request $request)
    {
        if (Auth::check()) {
            if ($request->isMethod('post')) {
                $user_id = Auth::user()->id;
                return Redirect::route('guest::onboarding::occupation', array('page' => 'occupation'));
            } else {

                return view('public.pages.preferences', [
                    'page'=> 'occupation'
                ]);
            }
        } else {
            return view('public.pages.homepage');
        }
    }
}
