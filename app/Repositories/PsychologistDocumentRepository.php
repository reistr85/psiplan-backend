<?php


namespace App\Repositories;


use App\Models\PsychologistDocument;

class PsychologistDocumentRepository extends BaseRepository
{
    private $model;

    public function __construct(PsychologistDocument $model)
    {
        $this->model = $model;
    }

    public function getByPsychologistId($psychologist_id)
    {
        return $this->model->where('psychologist_id', $psychologist_id);
    }

    public function store($data)
    {
        return $this->model::create($data);
    }

    public function destroy(PsychologistDocument $psychologistDocument)
    {
        return $psychologistDocument->delete();
    }

    public function edit(PsychologistDocument $psychologistDocument, $data)
    {
        parent::update($psychologistDocument, $data);
    }
}
