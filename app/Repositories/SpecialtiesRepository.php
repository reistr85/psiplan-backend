<?php


namespace App\Repositories;


use App\Models\PsychologistSpecialty;
use App\Models\Specialty;

class SpecialtiesRepository
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

    public function getByPsychologist($psychologist_id)
    {

    }
}
