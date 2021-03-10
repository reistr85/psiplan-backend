<?php


namespace App\Services\API\v1\SendEmail;

use App\Mail\ForgotPasswordClient;
use App\Repositories\QueryRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Mail;
use stdClass;

class SendEmailForgotPasswordClientService
{
    private $user_repository;

    public function __construct(
        UserRepository $user_repository)
    {
        $this->user_repository = $user_repository;
    }

    public function execute($email)
    {
        $user = $this->user_repository->getUserByEmailOrCPF('email', $email);

        if(!$user)
            throw new \Exception('Este e-mail não foi localizado em nossa base de dados', 500);

        $data = new stdClass();
        $data =  [
            'email' => $user->email,
            'name' => $user->name,
            'url' => 'sdjaisjdiasjdioasjdijadijasjdas',
        ];

        Mail::send(new ForgotPasswordClient($data));
    }
}
