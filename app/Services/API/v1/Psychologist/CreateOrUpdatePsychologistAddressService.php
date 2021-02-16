<?php


namespace App\Services\API\v1\Psychologist;

use App\Models\PsychologistAddress;
use App\Repositories\PsychologistRepository;

class CreateOrUpdatePsychologistAddressService
{
    private $psychologist_repository;
    private $psychologist_address;

    public function __construct(
        PsychologistRepository $psychologist_repository, PsychologistAddress $psychologist_address)
    {
        $this->psychologist_repository = $psychologist_repository;
        $this->psychologist_address = $psychologist_address;
    }

    public function execute(array $data)
    {
        $psychologist = auth()->user()->psychologist;

        $psychologist_address['psychologist_id'] = $psychologist->id;
        $psychologist_address['zip_code'] = $data['zipcode'];
        $psychologist_address['state'] = $data['state'];
        $psychologist_address['city'] = $data['city'];
        $psychologist_address['neighborhood'] = $data['neighborhood'];
        $psychologist_address['street'] = $data['street'];
        $psychologist_address['number'] = array_key_exists("street_number", $data) ? $data['street_number'] : '000';
        $psychologist_address['complement'] = "";

        if(!$psychologist->address) {
            $psychologist_address = $this->psychologist_repository->createPsychologistAddress(
                $this->psychologist_address, $psychologist_address);
        }else{
            $psychologist_address = $this->psychologist_repository->updatePsychologistAddress(
                $psychologist->address, $psychologist_address);
        }


        if(!$psychologist_address)
            throw new \Exception("Erro ao cadastrar o endereço", 500);

        return $psychologist_address;
    }
}
