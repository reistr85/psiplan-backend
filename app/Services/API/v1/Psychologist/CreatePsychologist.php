<?php


namespace App\Services\API\v1\Psychologist;


use App\Repositories\PsychologistRepository;

class CreatePsychologist extends PsychologistRepository
{
    public function execute($data)
    {
        $psychologist = parent::store($data);

        if(!$psychologist)
            throw new \Exception("Erro ao criar o psicólogo.", 500);

        return $psychologist;
    }
}
