<?php


namespace App\Repositories;


use App\Models\Evaluation;

class EvaluationRepository extends BaseRepository
{
    private $model;

    public function __construct(Evaluation $model)
    {
        $this->model = $model;
    }

    public function getAllByPsychologistId(int $psychologist_id)
    {
        return $this->model->join('queries', 'queries.id', 'evaluations.query_id')
            ->where('queries.psychologist_id', $psychologist_id)
            ->with('client');
    }

    public function store($data)
    {
        return parent::save($this->model, $data);
    }


}
