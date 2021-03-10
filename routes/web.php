    <?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Mail;

Route::get('new-psychologist', function(){

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
    ];

    Mail::send(new \App\Mail\NewQueryClient($data));

    //return new \App\Mail\NewQueryClient($data);
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
