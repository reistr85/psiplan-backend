<?php

use Illuminate\Http\Request;
use App\Services\NFeService;

Route::group(['prefix' => 'psiplan/v1', 'namespace' => 'Api\\v1', 'middleware' => ['apiKey']], function() {

    /*
     * Auth
     * */
    Route::post('login', 'AuthController@login');

    /*
     * Routes Users
     * */
    Route::resource('users', 'UserController');
    Route::post('forgot-password', 'UserController@forgotPassword');
});

Route::group(['prefix' => 'psiplan/v1', 'namespace' => 'Api\\v1', 'middleware' => ['apiKey', 'apiJwt']], function() {

    Route::get('/', function(){ return response()->json(['status' => true]); });

    /*
     * Routes Auth
     * */
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('logout', 'AuthController@logout');



});
