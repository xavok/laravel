<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/***** ADMIN ****/


Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin::' ], function() {

    Route::get('/', [
        'as' => 'dashboard',
        'uses' => 'DashboardController@index',
    ]);
    Route::group([ 'prefix' => 'seeker', 'as' => 'seeker::', 'namespace' => 'JobSeeker', ], function() {

        Route::get('/', [
            'as' => 'list',
            'uses' => 'JobSeekerController@index',
        ]);

        Route::get('/create', [
            'as' => 'create',
            'uses' => 'JobSeekerController@create',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'edit',
            'uses' => 'JobSeekerController@edit',
        ]);

        Route::post('/create', [
            'as' => 'store',
            'uses' => 'JobSeekerController@store',
        ]);

        Route::post('/update/{id}', [
            'as' => 'update',
            'uses' => 'JobSeekerController@update',
        ]);

        Route::get('/delete/{id}', [
            'as' => 'delete',
            'uses' => 'JobSeekerController@delete',
        ]);

    });

});
/***** PUBLIC ****/
Route::group([ 'as' => 'ajax::', ], function() {

    Route::post('ajax/login', [
        'as' => 'login',
        'uses' => 'AjaxController@login'
    ]);

    Route::get('/occupation-types/{id}', [
        'as' => 'occupation-types',
        'uses' => 'AjaxController@occupationTypes'
    ]);

    Route::get('/cultural-choices/{profile_id}', [
        'as' => 'cultural-choices',
        'uses' => 'AjaxController@culturalChoices'
    ]);
});
//Job seeker
Route::group([ 'namespace' => 'Guest', 'as' => 'guest::', ], function() {

    Route::get('/', [
        'as' => 'home',
        'uses' => 'HomepageController@index'
    ]);

    Route::get('/about', [
        'as' => 'about',
        'uses' => 'HomepageController@about'
    ]);
    Route::get('/terms-of-service', [
        'as' => 'terms-of-service',
        'uses' => 'HomepageController@tos'
    ]);
    Route::get('/privacy-terms', [
        'as' => 'privacy-terms',
        'uses' => 'HomepageController@ps'
    ]);

    Route::post('/login', [
        'as' => 'login',
        'uses' => 'HomepageController@login',
    ]);

    Route::get('/logout', [
        'as' => 'logout',
        'uses' => 'HomepageController@logout',
    ]);

    Route::get('/register', [
        'as' => 'register',
        'uses' => 'HomepageController@register',
    ]);

    Route::post('/register', [
        'as' => 'register',
        'uses' => 'HomepageController@register',
    ]);

    Route::get('/profile', [
        'as' => 'profile',
        'uses' => 'ProfileController@index',
    ])->middleware(\App\Http\Middleware\ProfileStatus::class);

    Route::get('/onboarding/about-you', [
        'as' => 'onboarding',
        'uses' => 'OnboardingController@index',
    ]);
    Route::group([  'prefix' => 'onboarding', 'as' => 'onboarding::', ], function() {
        Route::get('/about-you', [
            'as' => 'about-you',
            'uses' => 'OnboardingController@index',
        ]);

        Route::post('/about-you', [
            'as' => 'about-you',
            'uses' => 'OnboardingController@index',
        ]);

        Route::get('/occupation', [
            'as' => 'occupation',
            'uses' => 'OnboardingController@occupation',
        ]);

        Route::post('/occupation', [
            'as' => 'occupation',
            'uses' => 'OnboardingController@occupation',
        ]);

        Route::get('/industry', [
            'as' => 'industry',
            'uses' => 'OnboardingController@industry',
        ]);

        Route::post('/industry', [
            'as' => 'industry',
            'uses' => 'OnboardingController@industry',
        ]);

        Route::get('/education', [
            'as' => 'education',
            'uses' => 'OnboardingController@education',
        ]);

        Route::post('/education', [
            'as' => 'education',
            'uses' => 'OnboardingController@education',
        ]);

        Route::get('/qualification', [
            'as' => 'qualification',
            'uses' => 'OnboardingController@qualification',
        ]);

        Route::post('/qualification', [
            'as' => 'qualification',
            'uses' => 'OnboardingController@qualification',
        ]);

        Route::get('/cultural', [
            'as' => 'cultural',
            'uses' => 'OnboardingController@cultural',
        ]);

        Route::post('/cultural', [
            'as' => 'cultural',
            'uses' => 'OnboardingController@cultural',
        ]);
    });

});
//Company
Route::group([ 'namespace' => 'Guest', 'as' => 'guest::', ], function() {


    Route::get('/company/register', [
        'as' => 'company-register',
        'uses' => 'CompanyController@register',
    ]);

    Route::post('/company/register', [
        'as' => 'company-register-post',
        'uses' => 'CompanyController@register',
    ]);
    Route::get('/company/command-center', [
        'as' => 'command-center',
        'uses' => 'CompanyController@commandCenter',
    ]);

    Route::group([  'prefix' => 'create', 'as' => 'create::', ], function() {
        Route::get('/about', [
            'as' => 'about-job',
            'uses' => 'JobController@index',
        ]);

        Route::post('/about', [
            'as' => 'about-job',
            'uses' => 'JobController@index',
        ]);

        Route::get('/industry', [
            'as' => 'industry',
            'uses' => 'JobController@industry',
        ]);

        Route::post('/industry', [
            'as' => 'industry',
            'uses' => 'JobController@industry',
        ]);
    });

});
