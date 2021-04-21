    <?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Mail;
use App\Jobs\FreeDayScheduling;
use App\Jobs\SendEmailUpdatePlan;
use App\Jobs\SendEmailEvaluationQuery;

Route::get('/', function(){
    return response()->json(['status' => true, 'APP_NAME' => env('APP_NAME')]);
});

//Route::resource('/', 'API\\v1\\PagarmePostBackController');

Route::get('new-psychologist', function(){

    $user = new stdClass();
    $user =  [
        'name' => 'Renan Reis',
        'email' => 'reis_trindade@hotmail.com'
    ];

    //Mail::send(new \App\Mail\NewPsychologist($user));

    //$query = App\Models\Query::find(1);
    //FreeDayScheduling::dispatch($query);

    return new \App\Mail\NewPsychologist($user);
});

Route::get('new-client', function(){

    $user = new stdClass();
    $user =  [
        'name' => 'Renan Reis',
        'email' => 'reis_trindade@hotmail.com'
    ];

    //Mail::send(new \App\Mail\NewPsychologist($user));

    return new \App\Mail\NewClient($user);
});

Route::get('new-query-client', function(){

    $data = new stdClass();
    $data =  [
        'email' => 'reis_trindade@hotmail.com',
        'name' => 'Renan Reis',
        'psychologist_name' => 'Igor de Oliveira JR.',
        'psychologist_contact' => '(84)98848-1941',
        'type_service' => 'Online',
        'video_platform' => 'Skype',
        'date_query' => '12 de Março (Sexta-feira)',
        'value_query' => 'Online',
        'hour_query' => '12:00',
    ];

    //Mail::send(new \App\Mail\NewQueryClient($data));

    return new \App\Mail\NewQueryClient($data);
});

Route::get('new-query-psychologist', function(){

    $data = new stdClass();
    $data =  [
        'email' => 'reis_trindade@hotmail.com',
        'name' => 'Renan Reis',
        'psychologist_name' => 'Igor de Oliveira JR.',
        'psychologist_contact' => '(84)98848-1941',
        'type_service' => 'Online',
        'video_platform' => 'Skype',
        'date_query' => '12 de Março (Sexta-feira)',
        'value_query' => 'Online',
        'hour_query' => '12:00',
        'client_name' => 'Nome Cliente',
        'client_contact' => '(84)98888-1944',
    ];

    //Mail::send(new \App\Mail\NewQueryClient($data));

    return new \App\Mail\NewQueryPsychologist($data);
});

Route::get('forgot-password-client', function(){

    $data = new stdClass();
    $data =  [
        'email' => 'reis_trindade@hotmail.com',
        'name' => 'Renan Reis',
        'url' => 'asdjaskdjkasjdlasljd',
    ];

    //Mail::send(new \App\Mail\NewQueryClient($data));

    return new \App\Mail\ForgotPasswordClient($data);
});

Route::get('query-canceled-client', function(){

    $data = new stdClass();
    $data =  [
        'email' => 'reis_trindade@hotmail.com',
        'name' => 'Renan Reis',
        'psychologist_name' => 'Igor de Oliveira JR.',
        'psychologist_contact' => '(84)98848-1941',
        'type_service' => 'Online',
        'video_platform' => 'Skype',
        'date_query' => '12 de Março (Sexta-feira)',
        'value_query' => 'Online',
        'hour_query' => '00:00',
    ];

    //Mail::send(new \App\Mail\NewQueryClient($data));

    return new \App\Mail\QueryCanceledClient($data);
});

Route::get('consultation-free-client', function(){

    $data = new stdClass();
    $data =  [
        'client_email' => 'reis_trindade@hotmail.com',
        'client_name' => 'Renan Reis',
        'psychologist_name' => 'Igor de Oliveira JR.',
        'psychologist_email' => 'igorluz@gmail.com',
    ];

    //Mail::send(new \App\Mail\NewQueryClient($data));

    return new \App\Mail\ConsultationFreeClient($data);
});

Route::get('consultation-free-psychologist', function(){

    $data = new stdClass();
    $data =  [
        'client_email' => 'reis_trindade@hotmail.com',
        'client_name' => 'Renan Reis',
        'psychologist_name' => 'Igor de Oliveira JR.',
        'psychologist_email' => 'igorluz@gmail.com',
        'client_phone' => '(84)98848-1941)',
    ];

    //Mail::send(new \App\Mail\NewQueryClient($data));

    return new \App\Mail\ConsultationFreePsychologist($data);
});

Route::get('query-confirmed-client', function(){

    $data = new stdClass();
    $data =  [
        'email' => 'reis_trindade@hotmail.com',
        'name' => 'Renan Reis',
        'psychologist_name' => 'Igor de Oliveira JR.',
        'psychologist_contact' => '(84)98848-1941',
        'type_service' => 'Online',
        'video_platform' => 'Skype',
        'date_query' => '12 de Março (Sexta-feira)',
        'value_query' => 'Online',
        'hour_query' => '12:00',
    ];

    //Mail::send(new \App\Mail\NewQueryClient($data));

    return new \App\Mail\NewQueryClient($data);
});

Route::get('cancel-account', function(){

    $user = new stdClass();
    $user =  [
        'email' => 'reis_trindade@hotmail.com',
        'name' => 'Renan Reis',
    ];

    //Mail::send(new \App\Mail\CancelAccount($user));

    //\App\Jobs\SendEmailCancelAccount::dispatch($user);

    return new \App\Mail\CancelAccount($user);
});

Route::get('update-plan', function(){

    $user = new stdClass();
    $user =  [
        'email' => 'reis_trindade@hotmail.com',
        'name' => 'Renan Reis',
    ];

    //Mail::send(new \App\Mail\NewPsychologist($user));

    //\App\Jobs\SendEmailUpdatePlan::dispatch($user);

    return new \App\Mail\UpdatePlan($user);
});

Route::get('evaluation-query', function(){

    $user = new stdClass();
    $user =  [
        'email' => 'reis_trindade@hotmail.com',
        'name' => 'Renan Reis',
    ];

    //Mail::send(new \App\Mail\EvaluationQuery($user));

    //\App\Jobs\SendEmailEvaluationQuery::dispatch($user);

    return new \App\Mail\EvaluationQuery($user);
});
