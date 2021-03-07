<?php


namespace App\Services\API\v1\PaymentQueryClient;

use App\Models\Query;
use App\Repositories\QueryRepository;
use App\Services\API\v1\Pagarme\GetReceiptByRecipientIdService;
use GuzzleHttp\Client;

class CreatePaymentClientUniqueQueryPagarmeService extends QueryRepository
{
    private $get_recipient_by_recipient_id_service;

    public function __construct(
        Query $model,
        GetReceiptByRecipientIdService $get_recipient_by_recipient_id_service)
    {
        parent::__construct($model);

        $this->get_recipient_by_recipient_id_service = $get_recipient_by_recipient_id_service;
    }

    public function execute(int $client_id, array $data)
    {
        $query = parent::find($data['query_id']);
        $psychologist = $query->psychologist;

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
            'unit_price' => onlyNumber($data['amount']),
            'quantity' => '1',
            'tangible' => false,
        ];

        $recipient_psiplan = $this->get_recipient_by_recipient_id_service->execute(env('RECIPIENT_ID'));
        $recipient_psychologist = $this->get_recipient_by_recipient_id_service->execute($psychologist->recipient_id);

        $receiver_psiplan = [
            'recipient_id' => env('RECIPIENT_ID'),
            'percentage' => $recipient_psiplan->anticipatable_volume_percentage,
            'liable' => true,
            'charge_processing_fee' => true,
        ];

        $receiver_psychologist = [
            'recipient_id' => $psychologist->recipient_id,
            'percentage' => $recipient_psychologist->anticipatable_volume_percentage,
            'liable' => false,
            'charge_processing_fee' => false,
        ];

        array_push($data['items'], $item);
        array_push($data['split_rules'], $receiver_psiplan);
        array_push($data['split_rules'], $receiver_psychologist);

        $data['api_key'] = env('API_KEY_PAGARME');
        $data['amount'] = onlyNumber($data['amount']);
        $data['card_expiration_date'] = onlyNumber($data['card_expiration_date']);
        $data['billing']['address']['country'] = "br";
        $data['billing']['address']['street_number'] = $data['billing']['address']['street_number'] ?? 'S/N';
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
