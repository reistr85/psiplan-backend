<?php


namespace App\Repositories;


use App\Models\PsychologistAvailabilityCalendar;
use Illuminate\Database\Eloquent\Builder;

class PsychologistAvailabilityCalendarRepository extends BaseRepository
{
    private $model;

    public function __construct(PsychologistAvailabilityCalendar $model)
    {
        $this->model = $model;
    }

    public function store(array $data)
    {
        return parent::save($this->model, $data);
    }


    /**
     * Get Psychologist Availability Calendar By Psychologist Id
     *
     * @param int $psychologist_id
     * @return Builder
     */
    public function getPsychologistAvailabilityCalendarByPsychologistId(int $psychologist_id): Builder
    {
        return $this->model::where('psychologist_id', $psychologist_id);
    }
}
