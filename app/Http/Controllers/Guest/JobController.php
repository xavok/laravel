<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Company\Companies;
use App\Models\Company\JobIndustry;
use App\Models\Countries;
use App\Models\Company\JobAddresses;
use App\Models\Company\JobInfo;
use App\Models\Company\JobProfile;
use App\Models\Industries;
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
                            return Redirect::route('guest::onboarding::industry');
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
                return Redirect::route('guest::onboarding::occupation');
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
}
