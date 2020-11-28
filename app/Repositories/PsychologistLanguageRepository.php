<?php


namespace App\Repositories;


use App\Models\PsychologistLanguage;
use Facade\Ignition\QueryRecorder\Query;

class PsychologistLanguageRepository extends BaseRepository
{
    private $model;

    public function __construct(PsychologistLanguage $model)
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

    public function destroy(PsychologistLanguage $psychologist_language)
    {
        return  $psychologist_language->delete();
    }
}
