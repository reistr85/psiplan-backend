<?php


namespace App\Repositories;


use App\Models\PsychologistNotification;
use Illuminate\Database\Eloquent\Model;

class PsychologistPreferenceRepository extends BaseRepository
{
    private $model;

    public function __construct(PsychologistNotification $model)
    {
        $this->model = $model;
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
