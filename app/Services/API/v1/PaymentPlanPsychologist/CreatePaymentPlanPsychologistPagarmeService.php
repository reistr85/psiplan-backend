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

    public function execute(array $data, &$subscription_id, &$transaction_id)
    {
        $psychologist = auth()->user()->psychologist;
        $plan = $this->plan_repository->getByName($data['plan_selected']['name'])->first();

        if(!$plan)
            throw new \Exception("O plano não foi localizado", 500);

        $client_guzlle = new Client();
        $url_base = env('URL_BASE_PAGARME');

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

        array_push($data['split_rules'], $receiver_psiplan);
        array_push($data['split_rules'], $receiver_psychologist);


        $data['api_key'] = env('API_KEY_PAGARME');
        $data['amount'] = '8500';

        $data['customer']['phone']['number'] = substr($data['customer']['phone']['number'], 2, 9);
        $data['customer']['phone']['ddd'] = substr($data['customer']['phone']['number'], 0, 2);

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
