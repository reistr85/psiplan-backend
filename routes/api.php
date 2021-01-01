<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'psiplan/v1', 'namespace' => 'API\\v1', 'middleware' => ['apiKey']], function() {

    /*
     * AuthController
     * */
    Route::post('login', 'AuthController@login');

    /*
     * UserController
     * */
    Route::resource('users', 'UserController');
    Route::post('forgot-password', 'UserController@forgotPassword');

    /*
     * ListPsychologist
     * */
    Route::get('list-psychologist', 'ListPsychologistController@index');
    Route::get('get-filters', 'ListPsychologistController@getFilters');
    Route::post('get-psychologist/{id}', 'ListPsychologistController@show');
    Route::get('get-psychologist-availability/{psychologist_id}/{type_service_id}', 'ListPsychologistController@getPsychologistAvailabilityByTypeServiceId');
    Route::post('get-psychologist-service-hours', 'ListPsychologistController@getServiceHours');

    /*
     * CityController
     * */
    Route::post('cities-by-name', 'CityController@getCitiesByName');

    /*
     * SMS
     * */
//    Route::post('sms', 'AuthController@sms');
});

Route::group(['prefix' => 'psiplan/v1', 'namespace' => 'API\\v1', 'middleware' => ['apiKey', 'apiJwt']], function() {

    Route::get('/', function(){ return response()->json(['status' => true]); });

    /*
     * AuthController
     * */
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('logout', 'AuthController@logout');

    /*
     * ProfileController
     * */
    Route::get('account/profile', 'ProfileController@index');
    Route::post('account/profile/{action?}', 'ProfileController@update');
    //Route::post('account/delete-image-gallery', 'ProfileController@deleteImageGallery');


    /*
     * PsychologistAcademicFormationController
     * */
    Route::post('account/formations', 'PsychologistAcademicFormationController@store');
    Route::delete('account/formations/{id}', 'PsychologistAcademicFormationController@destroy');

    /*
     * PsychologistSpecialtyController
     * */
    Route::post('account/specialties', 'PsychologistSpecialtyController@store');

    /*
     * PsychologistDocumentController
     * */
    Route::post('account/documents', 'PsychologistDocumentController@store');

    /*
     * AccountController
     * */
    Route::get('account/account', 'AccountController@index');
    Route::post('account/account', 'AccountController@store');

    /*
     * QueryController
     * */
    Route::get('account/queries', 'QueryController@index');
    Route::post('account/queries/type-service', 'QueryController@storeTypeService');
    Route::post('account/queries/info-extras', 'QueryController@storeInfoExtras');

    /*
     * PreferenceController
     * */
    Route::get('account/preferences', 'PreferenceController@index');
    Route::put('account/preferences/{id}', 'PreferenceController@update');
    Route::put('account/preferences/users/{id}', 'UserController@update');

    /*
     * CityController
     * */
    Route::post('cities', 'CityController@index');

    /*
     * PsychologistAvailabilityCalendarController
     * */
    Route::get('availability', 'PsychologistAvailabilityCalendarController@index');
    Route::post('availability', 'PsychologistAvailabilityCalendarController@store');
    Route::delete('availability/{id}', 'PsychologistAvailabilityCalendarController@destroy');
    Route::post('get-service-hours', 'PsychologistAvailabilityCalendarController@getServiceHours');
    Route::post('delete-all-hours', 'PsychologistAvailabilityCalendarController@destroyAll');
});
