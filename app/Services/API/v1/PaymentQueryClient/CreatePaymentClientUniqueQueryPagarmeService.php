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

        $response = $client->post("{$url_base}/transactions", [
            'headers' => [
                'Accept'     => 'application/json',
            ],
            'json' => $data,
        ]);

        if($response->getStatusCode() != 200)
            throw new \Exception("Ocorre um erro no pagamento!", $response->getStatusCode());

        return json_decode($response->getBody()->getContents());
    }
}
