<?php


namespace App\Services\API\v1\PaymentPlanPsychologist;


use App\Repositories\PsychologistBankRepository;
use GuzzleHttp\Client;

class CreatePagarmeBankService
{
    public function execute($data, &$bank_id)
    {
        $client_guzlle = new Client();
        $url_base = env('URL_BASE_PAGARME');

        $data_bank['api_key'] = env('API_KEY_PAGARME');
        $data_bank['bank_code'] = $data['bank_code'];
        $data_bank['agencia'] = $data['agency'];
        $data_bank['agencia_dv'] = $data['agency_dv'];
        $data_bank['conta'] =$data['number_account'];
        $data_bank['conta_dv'] = $data['number_account_dv'];
        $data_bank['document_number'] = $data['cpf_holder_account'];
        $data_bank['legal_name'] = $data['name_holder_account'];
        $data_bank['type'] = $data['bank_type_account'];


        $response = $client_guzlle->post("{$url_base}/bank_accounts", [
            'headers' => [
                'Accept'     => 'application/json',
            ],
            'json' => $data_bank,
        ]);

        if($response->getStatusCode() != 200)
            throw new \Exception("Ocorre um erro ao criar o banco!", $response->getStatusCode());

        $response = json_decode($response->getBody()->getContents());
        $bank_id = $response->id;

        return $response;
    }
}
