<?php


namespace App\Services\API\v1\Psychologist;


use App\Repositories\PsychologistRepository;

class GetPsychologistByUserIdService extends PsychologistRepository
{
    public function execute($user_id)
    {
        return parent::getByUserId($user_id);
    }
}
