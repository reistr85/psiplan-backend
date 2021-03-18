<?php


namespace App\Services\API\v1\Psychologist;


use App\Repositories\PsychologistAvailabilityCalendarRepository;

class DeleteAllAvailabilityCalendarByPsychologistIdAndTypeServiceIdService
{
    private $psychologist_availability_calendars_repository;

    public function __construct(
        PsychologistAvailabilityCalendarRepository $psychologist_availability_calendars_repository)
    {
        $this->psychologist_availability_calendars_repository = $psychologist_availability_calendars_repository;
    }

    public function execute(int $psychologist_id, int $type_service_id)
    {
        $psychologist_availabilities = $this->psychologist_availability_calendars_repository
            ->getAllByPsychologistIdAnTypeServiceIdNotAvailable($psychologist_id, $type_service_id)->get();

        foreach ($psychologist_availabilities as $value){
            $this->psychologist_availability_calendars_repository->destroy($value);
        }
    }
}
