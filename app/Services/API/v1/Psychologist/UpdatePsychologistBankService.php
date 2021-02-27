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

    public function execute($psychologist_bank, $bank_id)
    {
        return $this->psychologist_bank_repository->edit($psychologist_bank, ['bank_id' => $bank_id]);
    }
}
