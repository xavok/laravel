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

/***** PUBLIC ****/
Route::group([ 'as' => 'ajax::', ], function() {
    Route::get('/occupation-types/{id}', [
        'as' => 'occupation-types',
        'uses' => 'AjaxController@occupationTypes'
    ]);
});
Route::group([ 'namespace' => 'Guest', 'as' => 'guest::', ], function() {

    Route::get('/', [
        'as' => 'home',
        'uses' => 'HomepageController@index'
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
    ]);

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
