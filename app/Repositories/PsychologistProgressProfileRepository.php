<?php


namespace App\Repositories;


use App\Models\PsychologistAcademicFormation;
use Facade\Ignition\QueryRecorder\Query;

class PsychologistAcademicFormationRepository
{
    private $model;

    public function __construct(PsychologistAcademicFormation $model)
    {
        $this->model = $model;
    }

    /**
     * Get All Academic Formations by Psychologist Id.
     *
     * @param int $psychologist_id
     * @return Query
     */
    public function getAllByPsychologistId($psychologist_id)
    {
        return $this->model->where('psychologist_id', $psychologist_id);
    }

    public function getByIdAndPsychologistId($psychologist_id, $id)
    {
        return  $this->model::where('id', $id)->where('psychologist_id', $psychologist_id)->first();
    }

    public function store($data)
    {
        return  $this->model::create($data);
    }

    public function destroy(PsychologistAcademicFormation $psychologist_academic_formation)
    {
        return  $psychologist_academic_formation->delete();
    }
}
