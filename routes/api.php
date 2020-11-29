<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'psiplan/v1', 'namespace' => 'API\\v1', 'middleware' => ['apiKey']], function() {

    /*
     * Auth
     * */
    Route::post('login', 'AuthController@login');

    /*
     * Routes Users
     * */
    Route::resource('users', 'UserController');
    Route::post('forgot-password', 'UserController@forgotPassword');

    /*
     * Routes List of Psychologist
     * */
    Route::get('listpsychologist', 'ListPsychologist@index');
    Route::get('getfilters', 'ListPsychologist@getFilters');

    /*
     * SMS
     * */
//    Route::post('sms', 'AuthController@sms');
});

Route::group(['prefix' => 'psiplan/v1', 'namespace' => 'API\\v1', 'middleware' => ['apiKey', 'apiJwt']], function() {

    Route::get('/', function(){ return response()->json(['status' => true]); });

    /*
     * Routes Auth
     * */
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('logout', 'AuthController@logout');

    /*
     * Profile
     * */
    Route::get('account/profile', 'ProfileController@index');
    Route::post('account/profile', 'ProfileController@update');
    Route::post('account/profile', 'ProfileController@update');
    Route::post('account/profile/formations', 'PsychologistAcademicFormationController@store');
    Route::delete('account/profile/formations/{id}', 'PsychologistAcademicFormationController@destroy');
    Route::post('account/profile/specialties', 'PsychologistSpecialtyController@store');
    Route::post('account/profile/documents', 'PsychologistDocumentController@store');

    /*
     * Account
     * */
    Route::get('account/account', 'AccountController@index');
    Route::post('account/account', 'AccountController@store');

    /*
     * Preferences
     * */
    Route::get('account/preferences', 'PreferenceController@index');

    /*
     * City
     * */
    Route::post('city', 'CityController@index');
});
