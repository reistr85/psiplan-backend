<?php


namespace App\Services\API\v1\PaymentQueryClient;

use GuzzleHttp\Client;

class CreatePaymentClientUniqueQueryPagarmeService
{
    public function execute(array $data)
    {
        $client = new Client();

        $data['api_key'] = env('API_KEY_PAGARME');
        $url_base = env('URL_BASE_PAGARME');

        $request = $client->post("{$url_base}/transactions", [
            'headers' => [
                'Accept'     => 'application/json',
            ],
            'json' => $data,
        ]);

        $response = json_decode($request->getBody()->getContents());

        return $response;
    }
}
