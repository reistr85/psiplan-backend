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
