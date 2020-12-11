<?php


namespace App\Repositories;


use App\Models\PsychologistSpecialty;
use App\Models\Specialty;

class SpecialtyRepository
{
    private $model;

    public function __construct(Specialty $specialty)
    {
        $this->model = $specialty;
    }

    public function getAll()
    {
        return $this->model->select('*')->orderBy('description')->get();
    }

    public function getByPsychologist($psychologist_id)
    {

    }
}
