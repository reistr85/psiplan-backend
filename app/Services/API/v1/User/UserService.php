<?php
namespace App\Services\API\v1\User;

use App\Repositories\UserRepository;
use App\Services\API\v1\AuthService;
use App\User;

class UserService
{

    private $user;
    private $authService;
    private $userRepository;

    public function __construct(User $user, AuthService $authService, UserRepository $userRepository)
    {
        $this->user = $user;
        $this->authService = $authService;
        $this->userRepository = $userRepository;
    }

    public function userStore($data)
    {
        $pass = $data['password'];
        $data['password'] = bcrypt($data['password']);

        if(!$data['terms'])
            throw new \Exception("Você deve aceitar os termos de uso", 202);

        $this->user = $this->userRepository->store($data);

        if(!$this->user)
            throw new \Exception("Erro ao criar o usuário.", 500);

        $credentials = [
            'email' => $this->user->email,
            'password' => $pass,
        ];

        return $this->authService->login($credentials);
    }

    public function forgotPassword($data)
    {

        $column = 'email';

        if(is_numeric($data)){
            $column = 'cpf';

            if(!checkCPF($data))
                throw new \Exception("Digite um CPF válido.", 202);
        }

        $this->user = $this->userRepository->getUserByEmailOrCPF($column, $data);

        if(!$this->user)
            throw new \Exception("Usuário não localizado.", 202);

        if(!$this->sendEmailResetPassword($this->user))
            throw new \Exception("Erro ao recuperar sua senha. Tente novamente.", 500);

        return true;
    }

    private function sendEmailResetPassword($user)
    {
        //lógica para enviar e-mail de recuperação de senha.
        return true;
    }
}
