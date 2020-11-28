<?php


namespace App\Services\API\v1\Psychologist;


use App\Models\Psychologist;
use App\Repositories\PsychologistRepository;
use Illuminate\Http\Request;

class UpdatePsychologistService extends PsychologistRepository
{
    public function execute(Psychologist $psychologist, array $data)
    {
        $psi = parent::update($psychologist, $data);

        if(!$psi)
            throw new \Exception("Erro ao alterar o psicólogo.", 500);

        return $psi;
    }
}
