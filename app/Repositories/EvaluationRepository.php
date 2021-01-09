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

    public function store($data)
    {
        return parent::save($this->model, $data);
    }


}
