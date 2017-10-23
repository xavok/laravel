<?php

namespace App\Http\Middleware;

use App\Models\Seeker\SeekerIndustry;
use App\Models\Seeker\SeekerOccupation;
use App\Models\Seeker\SeekerPreferences;
use App\Models\Seeker\SeekerProfile;
use App\Models\Seeker\SeekerQualification;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProfileStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(Auth::check()) {
            $user_id = Auth::user()->id;
            $profile = SeekerProfile::where('user_id', $user_id)->first();
            $industry = SeekerIndustry::where('profile_id', $profile->id)->first();
            $occupation = SeekerOccupation::where('profile_id', $profile->id)->first();
            $preferences = SeekerPreferences::where('profile_id', $profile->id)->first();
            $qualifications = SeekerQualification::where('profile_id', $profile->id)->first();
            if($profile && $industry && $occupation && $preferences && $qualifications) {
                return $next($request);
            }
            Session::set('alert-danger', 'Please finish on boarding before viewing your profile.');
            return redirect()->guest('onboarding/about-you');
        }
    }
}
