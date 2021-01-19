<?php


namespace App\Services\API\v1\Psychologist;


use App\Enums\TypeServiceEnum;
use App\Repositories\PsychologistServiceAddressRepository;

class CreateOrUpdatePsychologistServiceAddressService extends PsychologistServiceAddressRepository
{
    public function execute(int $psychologist_id, array $address, array $type_services)
    {
        $address['psychologist_id'] = $psychologist_id;
        $psychologistServiceAddress = parent::getPsychologistServiceAddressByPsychologistId($psychologist_id);

        if(array_search(TypeServiceEnum::TYPE_SERVICE_PRESENTIAL, array_column($type_services, 'type_service_id')) === false &&
            array_search(TypeServiceEnum::TYPE_SERVICE_ONLINE, array_column($type_services, 'type_service_id')) !== false){
            if($psychologistServiceAddress)
                parent::destroy($psychologistServiceAddress);

            return true;
        }

        $address = array_map(function ($item) {
            return $item === null ? '' : $item;
        }, $address);

        if ($psychologistServiceAddress)
            return parent::update($psychologistServiceAddress, $address);

        return parent::store($address);
    }
}
