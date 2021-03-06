<?php


namespace App\Services\API\v1\Psychologist;


use App\Repositories\PsychologistBankRepository;

class UpdatePsychologistBankService
{
    private $psychologist_bank_repository;

    public function __construct(
        PsychologistBankRepository $psychologist_bank_repository)
    {
        $this->psychologist_bank_repository = $psychologist_bank_repository;
    }

    public function execute($data)
    {
        $psychologist =  auth()->user()->psychologist;
        $psychologist_bank = $this->psychologist_bank_repository->findByPsychologistId($psychologist->id)->first();

        if(!$psychologist_bank)
            throw new \Exception("Banco não localizado", 500);

        return $this->psychologist_bank_repository->edit($psychologist_bank, $data);
    }
}
