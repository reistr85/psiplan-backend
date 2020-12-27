<?php


namespace App\Repositories;


use App\Models\PsychologistAvailabilityCalendar;
use Exception;
use Illuminate\Database\Eloquent\Builder;

class PsychologistAvailabilityCalendarRepository extends BaseRepository
{
    private $model;

    public function __construct(PsychologistAvailabilityCalendar $model)
    {
        $this->model = $model;
    }

    /**
     * Find
     *
     * @param int $id
     * @return PsychologistAvailabilityCalendar
     */
    public function find(int $id)
    {
        return parent::findById($this->model, $id);
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

    /**
     * Get Psychologist Availability Calendar By Date By Psychologist Id
     *
     * @param int $psychologist_id
     * @param string $date
     * @return Builder
     */
    public function getPsychologistAvailabilityCalendarByDateByPsychologistId(int $psychologist_id, string $date): Builder
    {
        $date_initial = "{$date} 00:00:00";
        $date_finish = "{$date} 23:59:59";

        return $this->model::where('psychologist_id', $psychologist_id)->whereBetween('day_hour', [$date_initial, $date_finish]);
    }

    /**
     * Destroy
     *
     * @param PsychologistAvailabilityCalendar $psychologist_availability_calendar
     * @return boolean
     * @throws Exception
     */
    public function destroy(PsychologistAvailabilityCalendar $psychologist_availability_calendar): bool
    {
        return parent::delete($psychologist_availability_calendar);
    }
}
