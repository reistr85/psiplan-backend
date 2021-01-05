<?php


namespace App\Services\API\Payment;


use GuzzleHttp\Client;

class CreatePaymentUniqueQueryPagarmeService
{
    public function execute(array $data)
    {
        $client = new Client();
        $body_request = json_encode($data);
        $request = $client->post('https://api.pagar.me/1/transactions', [
            'headers' => [
                'Accept'     => 'application/json',
            ],
            'json' => $data,
        ]);

        $response = json_decode($request->getBody()->getContents());

        return $response;
    }
}
