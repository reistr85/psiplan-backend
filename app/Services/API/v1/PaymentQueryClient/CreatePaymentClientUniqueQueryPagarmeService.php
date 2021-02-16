<?php


namespace App\Services\API\v1\PaymentQueryClient;

use App\Repositories\QueryRepository;
use GuzzleHttp\Client;

class CreatePaymentClientUniqueQueryPagarmeService extends QueryRepository
{
    public function execute(int $client_id, array $data)
    {
        $query = parent::find($data['query_id']);

        if($query->client_id != $client_id)
            throw new \Exception("Não foi possível fazer o pagamento da consulta selecionada.", 500);

        if($query->status_payment == 'processing')
            throw new \Exception("Esta consulta já está com o pagamento em processamento.", 500);

        if($query->status_payment == 'authorized')
            throw new \Exception("Esta consulta já está com o pagamento autorizado.", 500);

        if($query->status_payment == 'paid')
            throw new \Exception("Esta consulta já está paga.", 500);

        if($query->status_payment == 'analyzing')
            throw new \Exception("Esta consulta já está com o pagamento em análise.", 500);

        if($query->status_payment == 'pending_review')
            throw new \Exception("Esta consulta já está com o pagamento em revisão.", 500);


        $client_guzlle = new Client();
        $url_base = env('URL_BASE_PAGARME');

        $item = [
            'id' => '1',
            'title' => 'Consulta PSIPLAN BRASIL',
            'unit_price' => '8500',
            'quantity' => '1',
            'tangible' => false,
        ];

        $receiver_psiplan = [
            'recipient_id' => env('RECIPIENT_ID'),
            'percentage' => 10,
            'liable' => true,
            'charge_processing_fee' => true,
        ];

        $receiver_psychologist = [
            'recipient_id' => 're_ck4g908ky02p5v26f0zgbj0jn',
            'percentage' => 90,
            'liable' => true,
            'charge_processing_fee' => true,
        ];

        array_push($data['items'], $item);
        array_push($data['split_rules'], $receiver_psiplan);
        array_push($data['split_rules'], $receiver_psychologist);

        $data['api_key'] = env('API_KEY_PAGARME');
        $data['amount'] = '8500';
        $data['card_expiration_date'] = onlyNumber($data['card_expiration_date']);
        $data['billing']['address']['country'] = "br";
        $data['customer']['documents'][0]['number'] = onlyNumber($data['customer']['documents'][0]['number']);
        $data['customer']['phone_numbers'] = ["+55".onlyNumber($data['customer']['phone_numbers'][0])];
        $data['customer']['birthday'] = dateEN($data['customer']['birthday']);

        $response = $client_guzlle->post("{$url_base}/transactions", [
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
