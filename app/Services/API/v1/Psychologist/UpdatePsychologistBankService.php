<?php


namespace App\Services\API\v1\Psychologist;


use App\Repositories\PsychologistBankRepository;

class UpdatePsychologistBankService
{
    private $psychologist_bank_repository;
    private $create_psychologist_bank_service;

    public function __construct(
        PsychologistBankRepository $psychologist_bank_repository,
        CreatePsychologistBankService $create_psychologist_bank_service)
    {
        $this->psychologist_bank_repository = $psychologist_bank_repository;
        $this->create_psychologist_bank_service = $create_psychologist_bank_service;
    }

    public function execute($data)
    {
        $psychologist =  auth()->user()->psychologist;
        $psychologist_bank = $this->psychologist_bank_repository->findByPsychologistId($psychologist->id)->first();

        if($psychologist_bank) {
            return $this->psychologist_bank_repository->edit($psychologist_bank, $data);
        }else{
            $data['type_account_name'] = $data['bank_type_account'];
            return $this->create_psychologist_bank_service->execute($psychologist, $data);
        }
    }
}
