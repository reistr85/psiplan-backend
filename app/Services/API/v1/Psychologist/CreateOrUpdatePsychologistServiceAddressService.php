<?php


namespace App\Services\API\v1\Psychologist;


use App\Repositories\PsychologistServiceAddressRepository;

class CreateOrUpdatePsychologistServiceAddressService extends PsychologistServiceAddressRepository
{
    public function execute(int $psychologist_id, array $data)
    {
        $data['psychologist_id'] = $psychologist_id;
        $data = array_filter($data);

        $psychologistServiceAddress = parent::getPsychologistServiceAddressByPsychologistId($psychologist_id);

        if($psychologistServiceAddress)
            return parent::update($psychologistServiceAddress, $data);

        return parent::store($data);
    }
}
