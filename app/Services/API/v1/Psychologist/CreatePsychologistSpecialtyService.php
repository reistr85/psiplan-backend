<?php


namespace App\Services\API\v1\Psychologist;


use App\Repositories\PsychologistSpecialtyRepository;

class CreatePsychologistSpecialtyService extends PsychologistSpecialtyRepository
{
    public function execute($psychologist_id, $specialties)
    {
        if(!count($specialties))
            throw new \Exception("É preciso selecionar pelo menos uma especialidade.", 500);


        $psychologist_specialties = parent::getAllByPsychologistId($psychologist_id)->get();

        $psychologist_specialties->map(function($item) {
            parent::destroy($item);
        });

        foreach($specialties as $specialty){
            $data = [
                'psychologist_id' => $psychologist_id,
                'specialty_id' => $specialty['id'],
            ];

            $psychologist_specialty = parent::store($data);

            if(!$psychologist_specialty)
                throw new \Exception("Erro ao registrar as especialidades. Tente novamente.", 500);
        }
    }
}
