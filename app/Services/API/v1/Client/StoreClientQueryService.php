<?php


namespace App\Services\API\v1\Client;


use App\Repositories\PsychologistAvailabilityCalendarRepository;
use App\Repositories\PsychologistRepository;
use App\Repositories\QueryRepository;
use DateTime;
use Exception;

class StoreClientQueryService
{
    private $psychologist_repositories;
    private $query_repositories;
    private $psychologist_availability_calendar_repositories;

    public function __construct(
        PsychologistRepository $psychologist_repositories,
        QueryRepository $query_repositories,
        PsychologistAvailabilityCalendarRepository $psychologist_availability_calendar_repositories)
    {
        $this->psychologist_repositories = $psychologist_repositories;
        $this->query_repositories = $query_repositories;
        $this->psychologist_availability_calendar_repositories = $psychologist_availability_calendar_repositories;
    }

    /**
     * Display the specified resource.
     *
     * @param array $data
     * @param array $coupons
     * @return array
     * @throws Exception
     */
    public function execute(array $data, array $coupons)
    {
        $psychologist = $this->psychologist_repositories->find($data['psychologist_id']);
        $current_date = date('Y-m-d');
        $current_time = date('H:i:s');

        if(!$psychologist)
            throw new Exception("O Especialista não foi localizado!", 500);

        $psychologist_availability_calendar = $this->psychologist_repositories
            ->getPsychologistAvailabilityCalendarByDayHourAndTypeServiceIdAndAvailabilityNull(
                $data['psychologist_id'], $data['day_hour'], $data['type_service_id'])->first();

        if(!$psychologist_availability_calendar)
            throw new Exception("A data e hora não está mais disponível!", 500);

        if($current_date > $data['date'])
            throw new Exception("A data selecionada já passou.", 500);

        $diff = gmdate('H', strtotime( $data['hour'].":00" ) - strtotime( $current_time ) );
        if($data['date'] <= $current_date && ($diff < 6))
            throw new Exception("A hora da consulta precisa ser pelo menos com 6 horas de antecedência.", 500);

        $price = $psychologist->consultation_value;

        if($data['query_box']){
          $data['query_box'] = 'yes';
          $price = $psychologist->consultation_package_value;
        }else{
          $data['query_box'] = 'not';
        }

        $dataQuery = [
            'psychologist_id' => $data['psychologist_id'],
            'client_id' => auth()->user()->client->id,
            'psychologist_availability_calendar_id' => $psychologist_availability_calendar->id,
            'day_hour' => "{$data['day_hour']}:00",
            'price' => $price,
            'coupon_id' => null,
            'video_platform_id' => $data['video_platform_id'],
            'query_box' => $data['query_box']
        ];

        $query = $this->query_repositories->store($dataQuery);

        if(!$query)
            throw new Exception("Ocorreu um erro ao salvar sua consulta. Tente novamente.", 500);

        $this->psychologist_availability_calendar_repositories->edit(
            $psychologist_availability_calendar, ['available' => 1]);

        return $query;
    }
}
