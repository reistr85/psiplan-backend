<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Requests\API\v1\ForgotPasswordRequest;
use App\Http\Requests\API\v1\ResetPasswordRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'psiplan/v1'], function() {
    Route::post('forgot-password', function(ForgotPasswordRequest $request){
        try{
            $user = User::whereEmail($request->input('email'))->first();

            if(!$user)
                return response()->json(['status' => false, 'message' => 'O e-mail não foi localizado!'], 500);

            $re = app(ForgotPasswordController::class)->sendResetLinkEmail($request);
            return response()->json(['status' => true, 'response' => $re], 200);
        }catch(\Exception $ex){
            return response()->json(['status' => false, 'message' => $ex->getMessage()], 500);
        }
    });

    Route::post('reset-password', function(ResetPasswordRequest $request){
        try{
            $user = User::whereEmail($request->input('email'))->first();

            if(!$user)
                return response()->json(['status' => false, 'message' => 'O e-mail não foi localizado!'], 500);

            app(ResetPasswordController::class)->reset($request);
            return response()->json(['status' => true,], 200);
        }catch(\Exception $ex){
            return response()->json(['status' => true, 'message' => $ex->getMessage()], 500);
        }
    });

    Route::group(['namespace' => 'API\\v1'], function() {
        Route::resource('post-backs', 'PagarmePostBackController');
    });

    Route::group(['namespace' => 'API\\v1', 'middleware' => ['apiKey']], function() {

        Route::group(['prefix' => 'dashboard'], function() {
            Route::post('login', 'AuthController@login');

            Route::group(['namespace' => 'Dashboard', 'middleware' => ['apiJwt']], function() {
                Route::resource('psychologists', 'PsychologistController');
                Route::resource('clients', 'ClientsController');
            });
        });

        /*
         * Config
         * */
        Route::get('maintenance', function(Request $request){
            if($request->header('environment') === 'dev')
                return response()->json(['status' => false]);
            return response()->json(['status' => env('APP_MAINTENANCE')]);
        });

        /*
         * AuthController
         * */
        Route::post('login', 'AuthController@login');


        /*
         * UserController
         * */
        Route::resource('users', 'UserController');

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
         * PagarmePlansController
         * */
        Route::resource('pagarme/plans', 'PagarmePlansController');

        /*
         * SMS
         * */
    //    Route::post('sms', 'AuthController@sms');
    });
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
    Route::post('account/profile', 'ProfileController@show');
    Route::put('account/profile/', 'ProfileController@update');
    Route::post('account/profile/avatar', 'ProfileController@update');
    Route::post('account/profile/gallery_tow', 'ProfileController@update');
    Route::post('account/profile/gallery_three', 'ProfileController@update');
    Route::post('account/profile/gallery_four', 'ProfileController@update');
    Route::post('account/profile/gallery_five', 'ProfileController@update');
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
    Route::post('delete-all-hours-day-selected', 'PsychologistAvailabilityCalendarController@destroyAllDaySelected');

    /*
     * PsychologistAvailabilityCalendarController
     * */
    Route::get('availability', 'PsychologistAvailabilityCalendarController@index');

    /*
     * TypeServicesController
     * */
    Route::post('psychologist/payment/plan', 'PaymentPlanPsychologistController@store');
    Route::put('psychologist/payment/plan', 'PaymentPlanPsychologistController@update');

    /*
     * NotificationsController
     * */
    Route::resource('notifications', 'UserNotificationController');

    Route::group(['prefix' => 'management'], function() {
        Route::get('queries', 'ManagementQueryController@index');
        Route::put('queries/{id}', 'ManagementQueryController@update');
        Route::delete('queries/{id}', 'ManagementQueryController@destroy');
        Route::get('payments', 'ManagementPaymentController@index');
        Route::get('receipts', 'ManagementReceiptController@index');
        Route::get('evaluations', 'ManagementEvaluationController@index');
    });


    Route::group(['prefix' => 'client', 'middleware' => ['checkRouteClient']], function() {

        /*
        * Query
        * */
        Route::get('queries', 'ClientQueryController@index');
        Route::get('queries/{id}', 'ClientQueryController@show');
        Route::post('queries', 'ClientQueryController@store');

        /*
        * Payment
        * */
        Route::get('payment', 'PaymentQueryClientController@index');
        Route::post('payment', 'PaymentQueryClientController@store');

        /*
        * Evaluation
        * */
        Route::post('evaluations', 'EvaluationController@store');

        /*
        * Client
        * */
        Route::get('clients/{id}', 'ClientController@show');

        /*
        * ClientProfile
        * */
        Route::put('profile', 'ClientProfileController@update');

        /*
        * ClientBilling
        * */
        Route::put('billings', 'ClientBillingController@update');

        /*
        * ClientCoupons
        * */
        Route::resource('coupons', 'CouponController');

        /*
        * ClientConsultationFree
        * */
        Route::resource('consultation-free', 'ClientConsultationFreeController');
    });
});

