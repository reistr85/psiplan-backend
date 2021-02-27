<?php


namespace App\Services\API\v1\PaymentPlanPsychologist;


use GuzzleHttp\Client;

class CreatePagarmeRecipientService
{
    public function execute($psychologist, int $bank_id, &$recipient_id)
    {
        $client_guzlle = new Client();
        $url_base = env('URL_BASE_PAGARME');

        $data_recipient = [
            "api_key" => env('API_KEY_PAGARME'),
            "anticipatable_volume_percentage" => env('RECIPIENT_PERCENTAGE_PSYCHOLOGIST'),
            "automatic_anticipation_enabled" => "false",
            "bank_account_id" => $bank_id,
            "transfer_day" => "10",
            "transfer_enabled" => "true",
            "transfer_interval" => "monthly",
            "metadata" => [
                "id" => $psychologist->id,
                "name" => $psychologist->name,
            ]
        ];

        $response = $client_guzlle->post("{$url_base}/recipients", [
            'headers' => [
                'Accept'     => 'application/json',
            ],
            'json' => $data_recipient,
        ]);

        if($response->getStatusCode() != 200)
            throw new \Exception("Ocorre um erro ao criar o banco!", $response->getStatusCode());

        $response = json_decode($response->getBody()->getContents());
        $recipient_id = $response->id;

        return $response;
    }
}
