<?php


namespace App\Repositories;


use App\Models\PsychologistProgressProfile;
use Illuminate\Database\Eloquent\Model;

class PsychologistProgressProfileRepository extends BaseRepository
{
    private $model;

    public function __construct(PsychologistProgressProfile $model)
    {
        $this->model = $model;
    }

    public function getByPsychologistIdAndType(int $psychologist_id, string $type)
    {
        return $this->model
            ->where('psychologist_id', $psychologist_id)
            ->where('type', $type);
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
}
