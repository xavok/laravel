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

Route::group([ 'namespace' => 'Guest', 'as' => 'guest::', ], function() {

    Route::get('/', [
        'as' => 'welcome',
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
});
