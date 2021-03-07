<?php


namespace App\Services\API\v1\Pagarme;


use GuzzleHttp\Client;

class GetReceiptByRecipientIdService
{
    public function execute($recipient_id)
    {
        $client_guzlle = new Client();
        $url_base = env('URL_BASE_PAGARME');

        $data['api_key'] = env('API_KEY_PAGARME');
        $response = $client_guzlle->get("{$url_base}/recipients/{$recipient_id}", [
            'headers' => [
                'Accept'     => 'application/json',
            ],
            'json' => $data,
        ]);

        return json_decode($response->getBody()->getContents());
    }
}
