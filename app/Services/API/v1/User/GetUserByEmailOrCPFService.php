<?php
namespace App\Services\API\v1\User;

use App\Repositories\UserRepository;
use App\Services\API\v1\AuthService;
use App\User;

class GetUserByEmailOrCPFService extends UserRepository
{
    public function execute($column, $email)
    {
        return self::getUserByEmailOrCPF($column, $email);
    }
}
