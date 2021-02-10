<?php


namespace App\Services\API\v1\PaymentPlanPsychologist;


use GuzzleHttp\Client;

class ReversePaymentPlanPsychologistService
{
    public function execute(string $transaction_id)
    {
        $client_guzlle = new Client();
        $url_base = env('URL_BASE_PAGARME');

        $response = $client_guzlle->post("{$url_base}/transactions/{$transaction_id}/refund", [
            'headers' => [
                'Accept'     => 'application/json',
            ],
            'json' => [
                'api_key' => env('API_KEY_PAGARME')
            ],
        ]);
    }
}
