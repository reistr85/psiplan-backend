<?php


namespace App\Services\API\v1\Psychologist;


use App\Models\Evaluation;
use App\Repositories\ClientRepository;
use App\Repositories\EvaluationRepository;
use App\Repositories\PsychologistRepository;
use App\Repositories\QueryRepository;

class CreateEvaluationPsychologistService extends EvaluationRepository
{
    private $query_repository;

    public function __construct(
        Evaluation $model,
        QueryRepository $query_repository)
    {
        parent::__construct($model);

        $this->query_repository = $query_repository;
    }

    public function execute(array $data_evaluation)
    {
        $query = $this->query_repository->find($data_evaluation['query_id']);

        if(!$query)
            throw new \Exception("A consulta não foi localizada.", 500);

        if($query->client_id != $data_evaluation['client_id'])
            throw new \Exception("O cliente da consulta não corresponde ao cliente que está avaliando.", 500);

        $data_evaluation['psychologist_id'] = $query->psychologist_id;
        $evaluation = parent::store($data_evaluation);

        if(!$evaluation)
            throw new \Exception("Ocorreu um erro ao tentar registrar sua avaliação. Tente novamente", 500);

        return $evaluation;
    }
}
