<?php


namespace App\Services\API\v1\Client;


use App\Repositories\PsychologistRepository;
use DateTime;
use Exception;

class StoreClientQueryService
{
    private $psychologist_repositories;

    public function __construct(
        PsychologistRepository $psychologist_repositories)
    {
        $this->psychologist_repositories = $psychologist_repositories;
    }

    /**
     * Display the specified resource.
     *
     * @param array $data
     * @throws Exception
     */
    public function execute(array $data)
    {
        $psychologist = $this->psychologist_repositories->find($data['psychologist_id']);
        $current_date = date('Y-m-d');
        $current_time = date('H:i:s');
        $current_date_time = date('Y-m-d H:i:s');

        if(!$psychologist)
            throw new Exception("O Especialista não foi localizado!", 500);

        $psychologist_availability_calendar = $this->psychologist_repositories
            ->getPsychologistAvailabilityCalendarByDayHourAndTypeServiceIdAndAvailabilityNull(
                $data['psychologist_id'], $data['day_hour'], $data['type_service_id'])->first();

        if(!$psychologist_availability_calendar)
            throw new Exception("A data e hora não está mais disponível!", 500);

        if($current_date > $data['date'])
            throw new Exception("A data selecionada já passou.", 500);


        $d1     =   new DateTime( $current_date_time );
        $d2     =   new DateTime( $data['hour'].":00" );
        $tempo = gmdate('H:i:s', strtotime( $data['hour'].":00" ) - strtotime( $current_time ) );
        $diff   =   $d2->diff($d1, true);
        throw new Exception($tempo, 500);
    }
}
