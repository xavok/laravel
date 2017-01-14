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
use App\Models\EducationLevel;
use App\Models\Industries;
use App\Models\Occupations;
use App\Models\OccupationSubtypes;
use App\Models\Phones;
use App\Models\Preferences;
use App\Models\Qualifications;
use App\Models\Seeker\SeekerEducation;
use App\Models\Seeker\SeekerIndustry;
use App\Models\Seeker\SeekerOccupation;
use App\Models\Seeker\SeekerPreferences;
use App\Models\Seeker\SeekerProfile;
use App\Models\Seeker\SeekerQualification;
use App\Models\StudyField;
use Carbon\Carbon;
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
                            return Redirect::route('guest::onboarding::occupation');
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
                return Redirect::route('guest::onboarding::education');
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
                for ($i = 0; $i < count($request->get('id')); $i++) {
                    $id = $request->get('id')[$i];
                    $seekerEducation = SeekerEducation::where('id', $id)->first();
                    if (!empty($seekerEducation)) {
                        $school = $request->get('school')[$i];
                        $school_exist = SeekerEducation::where('id', '!=', $id)->where('school', $school)->first();
                        if (!empty($school_exist)) {
                            $request->session()->flash('alert-danger', 'You can not add same school more than once.');
                            return Redirect::route('guest::onboarding::education');
                        } else {
                            $seekerEducation->school = $school;
                            $seekerEducation->education_level_id = $request->get('education_level_id')[$i];
                            $seekerEducation->study_field_id = $request->get('study_field_id')[$i];
                            $seekerEducation->graduation_date = $request->get('graduation')[$i];
                        }
                    } else {
                        $seekerEducation = new SeekerEducation();
                        $seekerEducation->school = $request->get('school')[$i];
                        $seekerEducation->education_level_id = $request->get('education_level_id')[$i];
                        $seekerEducation->study_field_id = $request->get('study_field_id')[$i];
                        $seekerEducation->graduation_date = $request->get('graduation')[$i];
                        $seekerEducation->profile_id = $profile_id;
                    }
                    $seekerEducation->save();
                }
                return Redirect::route('guest::onboarding::qualification');
            } else {
                $educationLevels = EducationLevel::all();
                $studyFields = StudyField::all();
                $seekerEducations = SeekerEducation::where('profile_id', $profile_id)->get();
                return view('public.pages.preferences', [
                    'levels' => $educationLevels,
                    'studyFields' => $studyFields,
                    'seekerEducations' => $seekerEducations,
                    'page' => 'education'
                ]);
            }
        } else {
            return Redirect::route('guest::home');
        }
    }

    public function qualification(Request $request)
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $profile = SeekerProfile::where('user_id', $user_id)->first();
            $profile_id = $profile->id;
            if ($request->isMethod('post')) {
                for ($i = 0; $i < count($request->get('id')); $i++) {
                    $id = $request->get('id')[$i];
                    $seekerQualification = SeekerQualification::where('id', $id)->first();
                    if (!empty($seekerQualification)) {
                        $qualification = $request->get('qualification')[$i];
                        $qualification_exist = SeekerQualification::where('id', '!=', $id)->where('qualification_id', $qualification)->first();
                        if (!empty($qualification_exist)) {
                            $request->session()->flash('alert-danger', 'You can not add same qualification more than once.');
                            return Redirect::route('guest::onboarding::education');
                        } else {
                            $seekerQualification->qualification_id = $qualification;
                            $seekerQualification->qualification_rank = rand(1,10);
                        }
                    } else {
                        $seekerQualification = new SeekerQualification();
                        $seekerQualification->qualification_id = $request->get('qualification')[$i];
                        $seekerQualification->qualification_rank = rand(1,10);
                        $seekerQualification->profile_id = $profile_id;
                    }
                    $seekerQualification->save();
                }
                return Redirect::route('guest::onboarding::cultural');
            } else {
                $qualifications = Qualifications::all();
                $seekerQualifications = SeekerQualification::where('profile_id', $profile_id)->get();
                return view('public.pages.preferences', [
                    'seekerQualifications' => $seekerQualifications,
                    'allQualifications' => $qualifications,
                    'page' => 'qualification'
                ]);
            }
        } else {
            return Redirect::route('guest::home');
        }
    }

    public function cultural(Request $request)
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $profile = SeekerProfile::where('user_id', $user_id)->first();
            $profile_id = $profile->id;
            if ($request->isMethod('post')) {
                $id = $request->get('id');
                $seekerPreferences = SeekerPreferences::where('id', $id)->first();
                if (!empty($seekerPreferences)) {
                    $seekerPreferences->fill($request->all());
                } else {
                    $seekerPreferences = new SeekerPreferences();
                    $seekerPreferences->fill($request->all());
                    $seekerPreferences->profile_id = $profile_id;
                }
                $seekerPreferences->save();
                return Redirect::route('guest::profile');
            } else {
                $preferences = Preferences::with('choices')->get();
                $seekerPreferences = SeekerPreferences::where('profile_id', $profile_id)->first();
                return view('public.pages.preferences', [
                    'seekerPreferences' => $seekerPreferences,
                    'preferences' => $preferences,
                    'profile_id' => $profile_id,
                    'page' => 'cultural'
                ]);
            }
        } else {
            return Redirect::route('guest::home');
        }
    }


}
