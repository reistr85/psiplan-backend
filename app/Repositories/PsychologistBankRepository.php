<?php


namespace App\Repositories;

use App\Models\PsychologistBank;
use Illuminate\Database\Eloquent\Model;

class PsychologistBankRepository extends BaseRepository
{
    private $model;

    public function __construct(PsychologistBank $model)
    {
        $this->model = $model;
    }

    public function find($id): Model
    {
        return parent::findById($this->model, $id);
    }

    public function findByPsychologistId($id)
    {
        return $this->model->where('psychologist_id', $id);
    }

    /**
     * Store
     *
     * @param array $data
     * @return Model
     */
    public function store(array $data): Model
    {
        return parent::save($this->model, $data);
    }

    public function edit($model, $data): bool
    {
        return parent::update($model, $data);
    }
}
