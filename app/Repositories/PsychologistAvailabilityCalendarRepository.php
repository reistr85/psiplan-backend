<?php


namespace App\Repositories;


use App\Models\Psychologist;
use App\Models\PsychologistAvailabilityCalendar;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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

    public function edit(Model $model, array $data)
    {
        return parent::update($model, $data);
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
     * Get Psychologist Availability Calendar By Psychologist Id By TypeService Id
     *
     * @param int $psychologist_id
     * @param int $type_service_id
     * @return Builder
     */
    public function getPsychologistAvailabilityCalendarByPsychologistIdByTypeServiceId(int $psychologist_id, int $type_service_id): Builder
    {
        return $this->model::where('psychologist_id', $psychologist_id)->where('type_service_id', $type_service_id);
    }

    /**
     * Get Psychologist Availability Calendar By Date By Psychologist Id
     *
     * @param int $psychologist_id
     * @param string $date
     * @return Builder
     */
    public function getPsychologistAvailabilityCalendarByDateByPsychologistId(int $psychologist_id, array $data): Builder
    {
        $date_initial = "{$data['date']} 00:00:00";
        $date_finish = "{$data['date']} 23:59:59";

        $query = $this->model::where('psychologist_id', $psychologist_id)->whereBetween('day_hour', [$date_initial, $date_finish]);

        if($data['type_service_id'])
            $query->where('type_service_id', $data['type_service_id']);

        return $query;
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

    /**
     * Destroy ALl
     *
     * @param Psychologist $psychologist
     * @return boolean
     * @throws Exception
     */
    public function destroyAll(Psychologist $psychologist): bool
    {
        return $psychologist->availabilityCalendars()->whereNull('available')->delete();
    }

    /**
     * Destroy ALl
     *
     * @param int $psychologist_id
     * @param string $day_selected
     * @return Builder
     */
    public function getAllHoursDaySelectedByPsychologistId(int $psychologist_id, string $day_selected): Builder
    {
        $start_day = "{$day_selected} 00:00:00";
        $final_day = "{$day_selected} 23:59:59";

        return $this->model::where('psychologist_id', $psychologist_id)->whereBetween('day_hour', [$start_day, $final_day]);
    }
}
