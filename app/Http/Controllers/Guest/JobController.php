<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Company\Companies;
use App\Models\Countries;
use App\Models\Company\JobAddresses;
use App\Models\Company\JobInfo;
use App\Models\Company\JobProfile;
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

                return Redirect::route('guest::onboarding::industry');
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
}
