<?php


namespace App\Services\API\v1\Psychologist;

use App\Repositories\PsychologistTypeServiceRepository;

class CreatePsychologistTypeServiceService extends PsychologistTypeServiceRepository
{
    public function execute(int $psychologist_id, array $type_services)
    {
        $psychologist_type_services = parent::getPsychologistTypeServiceByPsychologistId($psychologist_id)->get();

        foreach($psychologist_type_services as $psychologist_type_service){
            parent::destroy($psychologist_type_service);
        }

        foreach($type_services as $key => $type_service){
            $psychologist_type_service = [
              'psychologist_id' => $psychologist_id,
              'type_service_id' => $type_service['type_service_id'],
            ];

            parent::store($psychologist_type_service);
        }
    }
}
