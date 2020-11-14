<?php


namespace App\Observers\API\v1;


use App\User;

class UserObserver
{
    public function creating(User $user)
    {
        $user->is_active = 1;
    }
}
