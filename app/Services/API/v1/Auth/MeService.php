<?php


namespace App\Services\API\v1\Auth;


use App\Repositories\PsychologistRepository;
use Exception;

class MeService extends PsychologistRepository
{
    /**
     * Get the authenticated User.
     *
     * @param $user
     * @return array
     * @throws Exception
     */
    public function execute($user)
    {
        $psychologist = parent::getByUserId($user->id);

        if(!$user)
            throw new Exception('Usuário não encontrado', 500);

        return [
            'id' => encode($user->id),
            'name' => $user->name,
            'email' => $user->email,
            'plan_id' => encode($psychologist->plan_id),
        ];
    }
}
