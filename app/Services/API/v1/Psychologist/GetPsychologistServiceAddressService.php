<?php


namespace App\Services\API\v1\Psychologist;


use App\Repositories\PsychologistServiceAddressRepository;

class GetPsychologistServiceAddressService extends PsychologistServiceAddressRepository
{
    public function execute(int $psychologist_id)
    {
        return parent::getPsychologistServiceAddressByPsychologistId($psychologist_id);
    }
}
