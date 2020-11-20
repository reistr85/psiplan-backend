<?php


namespace App\Repositories;


use App\Models\PsychologistAcademicFormation;

class PsychologistAcademicFormationRepository
{
    private $model;

    public function __construct(PsychologistAcademicFormation $model)
    {
        $this->model = $model;
    }

    public function store($data)
    {
        return  $this->model::create($data);
    }
}
