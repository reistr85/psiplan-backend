<?php


namespace App\Services\API\v1\Pagarme;


use GuzzleHttp\Client;

class GetReceiptsPsychologistService
{
    public function execute($psychologist)
    {
        $client_guzlle = new Client();
        $url_base = env('URL_BASE_PAGARME');

        $data['api_key'] = env('API_KEY_PAGARME');
        $response = $client_guzlle->get("{$url_base}/recipients/{$psychologist->recipient_id}/balance", [
            'headers' => [
                'Accept'     => 'application/json',
            ],
            'json' => $data,
        ]);

        return json_decode($response->getBody()->getContents());
    }
}
