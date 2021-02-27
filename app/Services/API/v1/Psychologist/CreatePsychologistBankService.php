<?php


namespace App\Services\API\v1\Psychologist;


use App\Repositories\PsychologistBankRepository;

class CreatePsychologistBankService
{
    private $psychologist_bank_repository;

    public function __construct(
        PsychologistBankRepository $psychologist_bank_repository)
    {
        $this->psychologist_bank_repository = $psychologist_bank_repository;
    }

    public function execute($psychologist, array $data)
    {
        $data_psychologist_bank = [
            'psychologist_id' => $psychologist->id,
            'bank_code' => $data['bank_code'],
            'bank_type_account' => $data['type_account_name'],
            'agency' => $data['agency'],
            'agency_dv' => $data['agency_dv'],
            'number_account' => $data['number_account'],
            'number_account_dv' => $data['number_account_dv'],
            'name_holder_account' => $data['name_holder_account'],
            'cpf_holder_account' => onlyNumber($data['cpf_holder_account']),
        ];

        $psychologist_bank = $this->psychologist_bank_repository->store($data_psychologist_bank);

        if(!$psychologist_bank)
            throw new \Exception("Erro ao cadastrar o banco do Psicólogo", 500);

        return $psychologist_bank;
    }
}
