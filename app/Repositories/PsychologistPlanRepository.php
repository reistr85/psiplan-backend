<?php


namespace App\Repositories;

use App\Models\PsychologistPlan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PsychologistPlanRepository extends BaseRepository
{
    private $model;

    public function __construct(PsychologistPlan $model)
    {
        $this->model = $model;
    }

    /**
     * All
     *
     * @param int $psychologist_id
     * @return Builder
     */
    public function allByPsychologistId(int $psychologist_id): Builder
    {
        return $this->model::where('psychologist_id', $psychologist_id);
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
