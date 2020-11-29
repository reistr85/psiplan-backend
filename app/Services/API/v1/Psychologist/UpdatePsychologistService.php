<?php


namespace App\Services\API\v1\Psychologist;


use App\Models\Psychologist;
use App\Repositories\PsychologistRepository;
use Exception;
use Illuminate\Http\Request;

class UpdatePsychologistService extends PsychologistRepository
{
    /**
     * Update Psychologist
     *
     * @param Psychologist $psychologist
     * @param array $data
     * @return bool
     * @throws Exception
     */
    public function execute(Psychologist $psychologist, array $data): bool
    {
        $psi = parent::update($psychologist, $data);

        if(!$psi)
            throw new Exception("Erro ao alterar o psicólogo.", 500);

        return $psi;
    }
}
