<?php


namespace App\Services\API\v1\Psychologist;


use App\Models\PsychologistAvailabilityCalendar;
use App\Repositories\PsychologistAvailabilityCalendarRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class CreatePsychologistAvailabilityCalendarService extends PsychologistAvailabilityCalendarRepository
{
    private $getPsychologistAvailabilityCalendarByPsychologistService;

    public function __construct(
        PsychologistAvailabilityCalendar $model,
        GetPsychologistAvailabilityCalendarByPsychologistIdService $getPsychologistAvailabilityCalendarByPsychologistService)
    {
        parent::__construct($model);

        $this->getPsychologistAvailabilityCalendarByPsychologistService = $getPsychologistAvailabilityCalendarByPsychologistService;
    }

    /**
     * Execute
     * @param int $psychologist_id
     * @param array $data
     * @throws Exception
     */
    public function execute(int $psychologist_id, array $data): void
    {
        DB::beginTransaction();
        try {
            $list_dates = $this->getListDates($data);
            $schedules = $this->getPsychologistAvailabilityCalendarByPsychologistService->execute($psychologist_id)
                            ->pluck('day_hour')
                            ->toArray();

            foreach ($list_dates as $key => $value) {
                if(array_search($value['date'], $schedules) === false)
                    parent::store([
                        'psychologist_id' => $psychologist_id,
                        'type_service_id' => $data['type_service_id'],
                        'day_hour' => $value['date'],
                        'is_active' => 1,
                    ]);
            }

            DB::commit();
        }catch (Exception $e){
            DB::rollBack();
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Get List Dates
     * @param array $data
     * @return array $day_time_available
     */
    private function getListDates(array $data): array
    {
        $day_time_available = [];
        $current_date_time = date('Y-m-d H:i:s');
        $qtd_day = 0;
        $day = [];
        $initial_date = "";

        if($data['week'])
            $qtd_day = 7*$data['week_repeat_id'];

        if($data['month']) {
            $year = date('Y');
            $month = $this->strPadLeft($data['months_selected'][count($data['months_selected'])-1]['id'], '2', '0');
            $m_day = $this->strPadLeft(cal_days_in_month(CAL_GREGORIAN, $month, $year), '2', '0');
            $last_date = "{$year}-{$month}-{$m_day}";

            if($month > date('m')){
                $initial_date = "{$year}-{$month}-01";
            }else{
                $initial_date = "{$year}-{$month}-".date('d');
            }

            $qtd_day = getdate(strtotime($last_date))['yday']-getdate(strtotime($initial_date))['yday'];
        }

        for($i=0; $i<=$qtd_day; $i++){
            $te = 1;
            array_push($day, getdate(strtotime("{$initial_date} +{$i} day")));
        }

        foreach($data['items'] as $key => $value){
            for($j=0; $j<count($day); $j++){
                if($day[$j]['weekday'] === $value['day_week_name']){
                    $year = $day[$j]['year'];
                    $mon = $this->strPadLeft($day[$j]['mon'], '2', '0');
                    $mday = $this->strPadLeft($day[$j]['mday'], '2', '0');
                    $date = "{$year}-{$mon}-{$mday} {$value['hour']}";

                    if(getdate(strtotime($date))[0] > getdate(strtotime($current_date_time))[0])
                        array_push($day_time_available, ['date' => $date]);
                }
            }
        }

        return $day_time_available;
    }

    /**
     * Str Pad Left
     * @param string $input
     * @param string $pad_length
     * @param string $pad_string
     * @return string
     */
    private function strPadLeft(string $input, string $pad_length, string $pad_string): string
    {
        return str_pad($input, $pad_length, $pad_string, STR_PAD_LEFT);
    }
}
