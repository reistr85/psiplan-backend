<?php


namespace App\Services\API\v1\PaymentPlanPsychologist;

use App\Models\Plan;
use App\Repositories\PlanRepository;
use App\Repositories\PsychologistRepository;
use GuzzleHttp\Client;

class CreatePaymentPlanPsychologistPagarmeService
{

    private $plan_repository;
    private $psychologist_repository;

    public function __construct(
        PlanRepository $plan_repository, PsychologistRepository $psychologist_repository)
    {
        $this->plan_repository = $plan_repository;
        $this->psychologist_repository = $psychologist_repository;
    }

    public function execute(array $data, $recipient_id, &$subscription_id, &$transaction_id)
    {
        $plan = $this->plan_repository->getByName($data['plan_selected']['name'])->first();

        if(!$plan)
            throw new \Exception("O plano não foi localizado", 500);

        $client_guzlle = new Client();
        $url_base = env('URL_BASE_PAGARME');

        $receiver_psiplan = [
            'recipient_id' => env('RECIPIENT_ID'),
            'percentage' => env('RECIPIENT_PERCENTAGE_PSIPLAN'),
            'liable' => true,
            'charge_processing_fee' => true,
        ];

        $receiver_psychologist = [
            'recipient_id' => $recipient_id,
            'percentage' => env('RECIPIENT_PERCENTAGE_PSYCHOLOGIST'),
            'liable' => true,
            'charge_processing_fee' => true,
        ];

        array_push($data['split_rules'], $receiver_psiplan);
        array_push($data['split_rules'], $receiver_psychologist);


        $data['api_key'] = env('API_KEY_PAGARME');
        $data['postback_url'] = env('URL_POST_BACK');
        $data['amount'] = onlyNumber($data['amount']);
        $data['card_expiration_date'] = onlyNumber($data['card_expiration_date']);
        $data['customer']['address']['street_number'] = "000";
        $data['customer']['document_number'] = onlyNumber($data['customer']['document_number']);
        $data['customer']['phone']['ddd'] = substr($data['customer']['phone']['number'], 1, 2);
        $data['customer']['phone']['number'] = onlyNumber(substr($data['customer']['phone']['number'], 4, 9));

        $response = $client_guzlle->post("{$url_base}/subscriptions", [
            'headers' => [
                'Accept'     => 'application/json',
            ],
            'json' => $data,
        ]);

        if($response->getStatusCode() != 200)
            throw new \Exception("Ocorre um erro no pagamento!", $response->getStatusCode());

        $response = json_decode($response->getBody()->getContents());
        $transaction_id = $response->current_transaction->id;
        $subscription_id = $response->id;

        return $response;
    }
}
