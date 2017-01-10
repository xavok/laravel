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
use App\Models\Industries;
use App\Models\Occupations;
use App\Models\OccupationSubtypes;
use App\Models\Phones;
use App\Models\Seeker\SeekerIndustry;
use App\Models\Seeker\SeekerOccupation;
use App\Models\Seeker\SeekerProfile;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;


class OnboardingController extends Controller
{

    public function index(Request $request)
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $profile = SeekerProfile::where('user_id', $user_id)->first();
            $profile_id = $profile->id;
            if ($request->isMethod('post')) {
                $country_id = $request->get('country_id');
                $zip = $request->get('zip');
                $phone_number = $request->get('phone');
                $profile->first_name = $request->get('first_name');
                $profile->last_name = $request->get('last_name');
                $profile->save();
                $address = Addresses::where('profile_id', $profile_id)->first();
                if (!empty($address)) {
                    $address->country_id = $country_id;
                    $address->zip = $zip;
                } else {
                    $address = new Addresses();
                    $address->country_id = $country_id;
                    $address->zip = $zip;
                    $address->profile_id = $profile_id;
                }
                $address->save();

                $phone = Phones::where('profile_id', $profile_id)->first();
                if (!empty($phone)) {
                    $phone->phone_number = $phone_number;
                } else {
                    $phone = new Phones();
                    $phone->phone_number = $phone_number;
                    $phone->profile_id = $profile_id;
                }
                $phone->save();

                return Redirect::route('guest::onboarding::industry');
            } else {
                $countries = Countries::orderByRaw("id='840' desc")->get();
                $address = $profile->address;
                $phone = $profile->phone;
                return view('public.pages.preferences', [
                    'profile' => $profile,
                    'countries' => $countries,
                    'address' => $address,
                    'phone' => $phone,
                    'page' => 'about-you'
                ]);
            }
        } else {
            return Redirect::route('guest::home');
        }
    }

    public function industry(Request $request)
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $profile = SeekerProfile::where('user_id', $user_id)->first();
            $profile_id = $profile->id;
            if ($request->isMethod('post')) {
                for ($i = 0; $i < count($request->get('id')); $i++) {
                    $id = $request->get('id')[$i];
                    $seekerIndustry = SeekerIndustry::where('id', $id)->first();
                    if (!empty($seekerIndustry)) {
                        $industry_id = $request->get('industry_id')[$i];
                        $industry_exist = SeekerIndustry::where('id', '!=', $id)->where('industry_id', $industry_id)->first();
                        if (!empty($industry_exist)) {
                            $request->session()->flash('alert-danger', 'You can not add same industry more than once.');
                            return Redirect::route('guest::onboarding::industry');
                        } else {
                            $seekerIndustry->industry_id = $request->get('industry_id')[$i];
                            $seekerIndustry->years = $request->get('industry_years')[$i];
                        }
                    } else {
                        $seekerIndustry = new SeekerIndustry();
                        $seekerIndustry->industry_id = $request->get('industry_id')[$i];
                        $seekerIndustry->years = $request->get('industry_years')[$i];
                        $seekerIndustry->profile_id = $profile_id;
                    }
                    $seekerIndustry->save();
                }
                return Redirect::route('guest::onboarding::occupation');
            } else {
                $industries = Industries::all();
                $seekerIndustries = SeekerIndustry::where('profile_id', $profile_id)->get();
                return view('public.pages.preferences', [
                    'industries' => $industries,
                    'seekerIndustries' => $seekerIndustries,
                    'page' => 'industry'
                ]);
            }
        } else {
            return Redirect::route('guest::home');
        }
    }

    public function occupation(Request $request)
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $profile = SeekerProfile::where('user_id', $user_id)->first();
            $profile_id = $profile->id;
            if ($request->isMethod('post')) {
                for ($i = 0; $i < count($request->get('id')); $i++) {
                    $id = $request->get('id')[$i];
                    $seekerOccupation = SeekerOccupation::where('id', $id)->first();
                    if (!empty($seekerOccupation)) {
                        $type_id = $request->get('type')[$i];
                        $type_exist = SeekerOccupation::where('id', '!=', $id)->where('occupation_subtype_id', $type_id)->first();
                        if (!empty($type_exist)) {
                            $request->session()->flash('alert-danger', 'You can not add same subtype occupation more than once.');
                            return Redirect::route('guest::onboarding::industry');
                        } else {
                            $seekerOccupation->occupation_id = $request->get('occupation')[$i];
                            $seekerOccupation->occupation_subtype_id = $type_id;
                            $seekerOccupation->years = $request->get('years')[$i];
                        }
                    } else {
                        $seekerOccupation = new SeekerOccupation();
                        $seekerOccupation->occupation_id = $request->get('occupation')[$i];
                        $seekerOccupation->occupation_subtype_id = $request->get('type')[$i];
                        $seekerOccupation->years = $request->get('years')[$i];
                        $seekerOccupation->profile_id = $profile_id;
                    }
                    $seekerOccupation->save();
                }
                return Redirect::route('guest::onboarding::occupation');
            } else {
                $occupations = Occupations::all();
                $seekerOccupations = SeekerOccupation::where('profile_id', $profile_id)->get();

                return view('public.pages.preferences', [
                    'occupations' => $occupations,
                    'seekerOccupations' => $seekerOccupations,
                    'page' => 'occupation'
                ]);
            }
        } else {
            return Redirect::route('guest::home');
        }
    }

    public function education(Request $request)
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $profile = SeekerProfile::where('user_id', $user_id)->first();
            $profile_id = $profile->id;
            if ($request->isMethod('post')) {
                return Redirect::route('guest::onboarding::education');
            } else {

                return view('public.pages.education', [
                    'page' => 'education'
                ]);
            }
        } else {
            return Redirect::route('guest::home');
        }
    }

}
