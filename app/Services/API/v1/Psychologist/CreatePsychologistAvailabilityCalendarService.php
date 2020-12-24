<?php


namespace App\Services\API\v1\Psychologist;


use App\Repositories\PsychologistAvailabilityCalendarRepository;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class CreatePsychologistAvailabilityCalendarService extends PsychologistAvailabilityCalendarRepository
{
    public function execute(int $psychologist_id, array $data): void
    {
        DB::beginTransaction();
        try {
            $list_dates = $this->getListDates($data);

            foreach ($list_dates as $key => $value) {
                parent::store([
                    'psychologist_id' => $psychologist_id,
                    'day_hour' => $value['date'],
                    'is_active' => 1,
                ]);
            }

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    private function getListDates(array $data)
    {
        $day_time_available = [];
        $today = date("Y-m-d");
        $qtd_day = 7*$data['week_repeat_id'];
        $day = [];

        for($i=0; $i<$qtd_day; $i++){
            array_push($day, getdate(strtotime("{$today} +{$i} day")));
        }

        foreach($data['items'] as $key => $value){
            for($i=0; $i<count($day); $i++){
                if($day[$i]['weekday'] === $value['day_week_name']){
                    $year = $day[$i]['year'];
                    $mon = str_pad($day[$i]['mon'], 2, "0", STR_PAD_LEFT);
                    $mday = str_pad($day[$i]['mday'], 2, "0", STR_PAD_LEFT);

                    $date = "{$year}-{$mon}-{$mday}";
                    array_push($day_time_available, ['date' => "{$date} {$value['hour']}"]);
                }
            }
        }

        return $day_time_available;
    }
}
