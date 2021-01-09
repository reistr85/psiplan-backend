<?php


namespace App\Services\API\v1\Psychologist;


use App\Repositories\EvaluationRepository;

class CreateEvaluationPsychologistService extends EvaluationRepository
{
    public function execute(array $data_evaluation)
    {
        $evaluation = parent::store($data_evaluation);

        if(!$evaluation)
            throw new \Exception("Ocorreu um erro ao tentar registrar sua avaliação. Tente novamente", 500);

        return $evaluation;
    }
}
