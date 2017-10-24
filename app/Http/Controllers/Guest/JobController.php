<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Jobs\Job;
use App\Models\Company\Companies;
use App\Models\Company\JobIndustry;
use App\Models\Countries;
use App\Models\Company\JobAddresses;
use App\Models\Company\JobInfo;
use App\Models\Company\JobProfile;
use App\Models\EducationLevel;
use App\Models\Industries;
use App\Models\Occupations;
use App\Models\Preferences;
use App\Models\Qualifications;
use App\Models\Company\JobEducation;
use App\Models\Company\JobOccupation;
use App\Models\Company\JobPreferences;
use App\Models\Company\JobQualification;
use App\Models\StudyField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class JobController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            $user_id =  Auth::user()->id;
            $company = Companies::where('user_id', $user_id)->first();
            if ($request->isMethod('post')) {
                $should_be_matched = $request->get('should_be_matched');
                $name = $request->get('name');
                $description = $request->get('description');
                $country_id = $request->get('country_id');
                $zip = $request->get('zip');
                $job_profile = new JobProfile();
                $job_profile->company_id = $company->id;
                $job_profile->should_be_matched= $should_be_matched;
                $job_profile->save();

                $job_info = new JobInfo();
                $job_info->job_id = $job_profile->id;
                $job_info->name = $name;
                $job_info->description = $description;
                $job_info->save();

                $job_address = JobAddresses::where('job_id', $job_profile->id)->first();
                if (!empty($address)) {
                    $address->country_id = $country_id;
                    $address->zip = $zip;
                } else {
                    $job_address = new JobAddresses();
                    $job_address->job_id = $job_profile->id;
                    $job_address->country_id = $country_id;
                    $job_address->zip = $zip;
                }
                $job_address->save();
                $request->session()->put('job_id', $job_profile->id);
                return Redirect::route('guest::create::industry');
            } else {
                $countries =  Countries::orderByRaw("id='840' desc")->get();
                return view('public.pages.company.create', [
                    'company' => $company,
                    'countries' => $countries,
                    'page' => 'about'
                ]);
            }
        } else {
            return Redirect::route('guest::home');
        }
    }

    public function industry(Request $request)
    {
        if (Auth::check()) {
            $job_id = $request->session()->get('job_id');
            if ($request->isMethod('post')) {
                for ($i = 0; $i < count($request->get('id')); $i++) {
                    $id = $request->get('id')[$i];
                    $jobIndustry = JobIndustry::where('id', $id)->first();
                    if (!empty($jobIndustry)) {
                        $industry_id = $request->get('industry_id')[$i];
                        $industry_exist = JobIndustry::where('id', '!=', $id)->where('industry_id', $industry_id)->where('job_id',$job_id)->first();
                        if (!empty($industry_exist)) {
                            $request->session()->flash('alert-danger', 'You can not add same industry more than once.');
                            return Redirect::route('guest::create::industry');
                        } else {
                            $jobIndustry->industry_id = $request->get('industry_id')[$i];
                            $jobIndustry->years = $request->get('industry_years')[$i];
                        }
                    } else {
                        $jobIndustry = new JobIndustry();
                        $jobIndustry->industry_id = $request->get('industry_id')[$i];
                        $jobIndustry->years = $request->get('industry_years')[$i];
                        $jobIndustry->job_id = $job_id;
                    }
                    $jobIndustry->save();
                }
                return Redirect::route('guest::create::occupation');
            } else {
                $industries = Industries::all();
                $jobIndustries = JobIndustry::where('job_id', $job_id)->get();
                return view('public.pages.company.create', [
                    'industries' => $industries,
                    'seekerIndustries' => $jobIndustries,
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
            $job_id = $request->session()->get('job_id');
            if ($request->isMethod('post')) {
                for ($i = 0; $i < count($request->get('id')); $i++) {
                    $id = $request->get('id')[$i];
                    $jobOccupation = JobOccupation::where('id', $id)->first();
                    if (!empty($jobOccupation)) {
                        $type_id = $request->get('type')[$i];
                        $type_exist = JobOccupation::where('id', '!=', $id)->where('occupation_subtype_id', $type_id)->where('job_id', $job_id)->first();
                        if (!empty($type_exist)) {
                            $request->session()->flash('alert-danger', 'You can not add same subtype occupation more than once.');
                            return Redirect::route('guest::create::occupation');
                        } else {
                            $jobOccupation->occupation_id = $request->get('occupation')[$i];
                            $jobOccupation->occupation_subtype_id = $type_id;
                            $jobOccupation->years = $request->get('years')[$i];
                        }
                    } else {
                        $jobOccupation = new JobOccupation();
                        $jobOccupation->occupation_id = $request->get('occupation')[$i];
                        $jobOccupation->occupation_subtype_id = $request->get('type')[$i];
                        $jobOccupation->years = $request->get('years')[$i];
                        $jobOccupation->job_id = $job_id;
                    }
                    $jobOccupation->save();
                }
                return Redirect::route('guest::create::education');
            } else {
                $occupations = Occupations::all();
                $jobOccupations = JobOccupation::where('job_id', $job_id)->get();

                return view('public.pages.company.create', [
                    'occupations' => $occupations,
                    'seekerOccupations' => $jobOccupations,
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
            $job_id = $request->session()->get('job_id');
            if ($request->isMethod('post')) {
                for ($i = 0; $i < count($request->get('id')); $i++) {
                    $id = $request->get('id')[$i];
                    $jobEducation = JobEducation::where('id', $id)->first();
                    if (!empty($jobEducation)) {
                        $education_level_id = $request->get('education_level_id')[$i];
                        $education_level_id_exist = JobEducation::where('id', '!=', $id)->where('education_level_id', $education_level_id)->where('job_id', $job_id)->first();
                        if (!empty($education_level_id_exist)) {
                            $request->session()->flash('alert-danger', 'You can not add same school more than once.');
                            return Redirect::route('guest::create::education');
                        } else {
                            $jobEducation->education_level_id = $request->get('education_level_id')[$i];
                            $jobEducation->study_field_id = $request->get('study_field_id')[$i];
                        }
                    } else {
                        $jobEducation = new JobEducation();
                        $jobEducation->education_level_id = $request->get('education_level_id')[$i];
                        $jobEducation->study_field_id = $request->get('study_field_id')[$i];
                        $jobEducation->job_id = $job_id;
                    }
                    $jobEducation->save();
                }
                return Redirect::route('guest::create::qualification');
            } else {
                $educationLevels = EducationLevel::all();
                $studyFields = StudyField::all();
                $jobEducations = JobEducation::where('job_id', $job_id)->get();
                return view('public.pages.company.create', [
                    'levels' => $educationLevels,
                    'studyFields' => $studyFields,
                    'seekerEducations' => $jobEducations,
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
            $job_id = $request->session()->get('job_id');
            if ($request->isMethod('post')) {
                for ($i = 0; $i < count($request->get('id')); $i++) {
                    $id = $request->get('id')[$i];
                    $jobQualification = JobQualification::where('id', $id)->first();
                    if (!empty($jobQualification)) {
                        $qualification = $request->get('qualification')[$i];
                        $qualification_exist = JobQualification::where('id', '!=', $id)->where('qualification_id', $qualification)->where('job_id', $job_id)->first();
                        if (!empty($qualification_exist)) {
                            $request->session()->flash('alert-danger', 'You can not add same qualification more than once.');
                            return Redirect::route('guest::create::education');
                        } else {
                            $jobQualification->qualification_id = $qualification;
                            $jobQualification->qualification_rank = rand(1,10);
                        }
                    } else {
                        $jobQualification = new JobQualification();
                        $jobQualification->qualification_id = $request->get('qualification')[$i];
                        $jobQualification->qualification_rank = rand(1,10);
                        $jobQualification->job_id = $job_id;
                    }
                    $jobQualification->save();
                }
                return Redirect::route('guest::create::cultural');
            } else {
                $qualifications = Qualifications::all();
                $jobQualifications = JobQualification::where('job_id', $job_id)->get();
                return view('public.pages.company.create', [
                    'seekerQualifications' => $jobQualifications,
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
            $job_id = $request->session()->get('job_id');
            if ($request->isMethod('post')) {
                $id = $request->get('id');
                $jobPreferences = JobPreferences::where('id', $id)->first();
                if (!empty($jobPreferences)) {
                    $jobPreferences->fill($request->all());
                } else {
                    $jobPreferences = new JobPreferences();
                    $jobPreferences->fill($request->all());
                    $jobPreferences->job_id = $job_id;
                }
                $jobPreferences->save();
                return Redirect::route('guest::command-center');
            } else {
                $preferences = Preferences::with('choices')->get();
                $jobPreferences = JobPreferences::where('job_id', $job_id)->first();
                return view('public.pages.company.create', [
                    'seekerPreferences' => $jobPreferences,
                    'preferences' => $preferences,
                    'job_id' => $job_id,
                    'page' => 'cultural'
                ]);
            }
        } else {
            return Redirect::route('guest::home');
        }
    }
}
