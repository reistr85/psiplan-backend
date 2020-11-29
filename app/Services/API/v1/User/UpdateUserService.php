<?php


namespace App\Services\API\v1\User;

use App\Repositories\UserRepository;
use App\User;

class UpdateUserService extends UserRepository
{
    /**
     * Update User
     *
     * @param User $user
     * @param array $data
     * */
    public function execute(User $user, array $data): Void
    {
        parent::update($user, $data);
    }
}
