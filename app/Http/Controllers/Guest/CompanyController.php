<?php

namespace App\Http\Controllers\Guest;

use App\Models\Company\Companies;
use App\Models\Company\JobIndustry;
use App\Models\Company\JobInfo;
use App\Models\Company\JobProfile;
use App\Models\Seeker\SeekerEducation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Models\Seeker\SeekerIndustry;
use App\Models\Seeker\SeekerOccupation;
use App\Models\Seeker\SeekerPreferences;
use App\Models\Seeker\SeekerProfile;
use App\Models\Seeker\SeekerQualification;
use App\Models\Company\JobEducation;
use App\Models\Company\JobOccupation;
use App\Models\Company\JobPreferences;
use App\Models\Company\JobQualification;

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
            $jobs = JobProfile::where('company_id',$company->id)->get();
            foreach($jobs as $job) {
                $jobinfo = JobInfo::where('job_id',$job->id)->first();
                $job->name = $jobinfo->name;
                $job->ranks = $this->rankJob($job->id);
            }
            return view('public.pages.company.command-center', ['company' => $company,'jobs'=>$jobs]);
        } else {
            return view('public.pages.homepage');
        }
    }

    private function rankJob($job_id) {
        $ranks = [];
        $user_profiles = SeekerProfile::all();
        $job_industry = JobIndustry::where('job_id', $job_id)->first();
        $job_occupation = JobOccupation::where('job_id', $job_id)->first();
        $job_preferences = JobPreferences::where('job_id', $job_id)->first();
        $job_qualifications = JobQualification::where('job_id', $job_id)->first();
        $job_education = JobEducation::where('job_id', $job_id)->first();

        foreach($user_profiles as $profile) {
            $rank = ['user_id'=>$profile->id];
            $user_industry = SeekerIndustry::where('profile_id', $profile->id)->first();
            $user_occupation = SeekerOccupation::where('profile_id', $profile->id)->first();
            $user_preferences = SeekerPreferences::where('profile_id', $profile->id)->first();
            $user_qualifications = SeekerQualification::where('profile_id', $profile->id)->first();
            $user_educations = SeekerEducation::where('profile_id', $profile->id)->first();
            if(!$user_industry || !$user_occupation || !$user_preferences || !$user_qualifications || !$user_educations) {
                continue;
            }
            if($user_industry->industry_id == $job_industry->industry_id) {
                if($user_industry->years >= $job_industry->years) {
                    $rank['industry'] = 100;
                } else {
                    $rank['industry'] = 90;
                }
            } else {
                $rank['industry'] = 0;
            }

            if($user_educations->study_field_id == $job_education->study_field_id) {
                if( $user_educations->education_level_id >= $job_education->education_level_id) {
                    $rank['education'] = 100;
                } else {
                    $rank['education'] = 90;
                }
            } else {
                $rank['education'] = 0;
            }

            if($user_occupation->occupation_id == $job_occupation->occupation_id) {
                if($user_occupation->occupation_subtype_id == $job_occupation->occupation_subtype_id) {
                    if ($user_occupation->years >= $job_occupation->years) {
                        $rank['occupation'] = 100;
                    } else {
                        $rank['occupation'] = 90;
                    }
                } else {
                    $rank['occupation'] = 50;
                }
            } else {
                $rank['occupation'] = 0;
            }

            if($user_preferences->workplace_1_id == $job_preferences->workplace_1_id &&
                $user_preferences->workplace_2_id == $job_preferences->workplace_2_id &&
                $user_preferences->workplace_3_id == $job_preferences->workplace_3_id &&
                $user_preferences->atmosphere_1_id == $job_preferences->atmosphere_1_id &&
                $user_preferences->atmosphere_2_id == $job_preferences->atmosphere_2_id &&
                $user_preferences->atmosphere_3_id == $job_preferences->atmosphere_3_id &&
                $user_preferences->workenvironment_1_id == $job_preferences->workenvironment_1_id &&
                $user_preferences->workenvironment_2_id == $job_preferences->workenvironment_2_id &&
                $user_preferences->workenvironment_3_id == $job_preferences->workenvironment_3_id &&
                $user_preferences->interaction_1_id == $job_preferences->interaction_1_id &&
                $user_preferences->interaction_2_id == $job_preferences->interaction_2_id &&
                $user_preferences->interaction_3_id == $job_preferences->interaction_3_id &&
                $user_preferences->microculture_1_id == $job_preferences->microculture_1_id &&
                $user_preferences->microculture_2_id == $job_preferences->microculture_2_id &&
                $user_preferences->microculture_3_id == $job_preferences->microculture_3_id
            ) {
                $rank['preferences'] = 100;
            } else {
                $rank['preferences'] = 90;
            }

            if($user_qualifications->qualification_id == $job_qualifications->qualification_id) {
                if($user_qualifications->qualification_rank >= $job_qualifications->qualification_rank) {
                    $rank['qualifications'] = 100;
                } else {
                    $rank['qualifications'] = 90;
                }
            } else {
                $rank['qualifications'] = 0;
            }

            $overall = ($rank['preferences'] + $rank['qualifications'] + $rank['education'] + $rank['occupation'] + $rank['industry'])/5;
            $rank['overall'] = $overall;

            $ranks[] = $rank;
        }
        $sort = [];
        foreach($ranks as $key => $row) {
            $sort[$key] = $row['overall'];
        }
        array_multisort($sort, SORT_DESC, $ranks);
        return $ranks;
    }
}
