<?php


namespace App\Services\API\v1\Psychologist;


use App\Repositories\PsychologistAvailabilityCalendarRepository;
use Illuminate\Database\Eloquent\Collection;

class GetServiceHoursByDateByPsychologistIdService extends PsychologistAvailabilityCalendarRepository
{
    public function execute(int $psychologist_id, array $data)
    {
        $data['date_initial'] = "{$data['date']} 00:00:00";
        $data['date_finish'] = "{$data['date']} 23:59:59";

        $query = parent::getPsychologistAvailabilityCalendarByDateByPsychologistId($psychologist_id, $data)->get();

        $data_min = date('Y-m-d H:i:m', strtotime('+360 minute', strtotime(date('Y-m-d H:i:m'))));
        $days_hours = $query->map(function($item) use ($data_min){
            if($item->day_hour <= $data_min)
                return null;

            return $item;
        });

        return array_values(array_filter($days_hours->toArray()));
    }
}
