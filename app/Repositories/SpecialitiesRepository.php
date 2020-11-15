<?php


namespace App\Repositories;


use App\Models\Specialty;

class SpecialitiesRepository
{
    private $model;

    public function __construct(Specialty $specialty)
    {
        $this->model = $specialty;
    }

    public function getAll()
    {
        return $this->model->all();
    }
}
