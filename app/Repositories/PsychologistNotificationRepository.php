<?php


namespace App\Repositories;


use App\Models\PsychologistPreference;
use Illuminate\Database\Eloquent\Builder;

class PsychologistNotificationRepository extends BaseRepository
{
    private $model;

    public function __construct(PsychologistPreference $model)
    {
        $this->model = $model;
    }

    /**
     * Update PsychologistPreference
     *
     * @param int $psychologist_id
     * @param int $preference_id
     * @return Builder
     * */
    public function getPsychologistPreferenceByPsychologistIdAndPreferenceId(int $psychologist_id, int $preference_id): Builder
    {
        return $this->model::where('psychologist_id', $psychologist_id)->where('preference_id', $preference_id);
    }
}
