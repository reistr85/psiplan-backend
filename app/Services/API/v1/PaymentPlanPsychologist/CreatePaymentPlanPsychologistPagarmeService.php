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

    public function execute(array $data)
    {
        $psychologist = auth()->user()->psychologist;

        if(!$psychologist->address)
            $this->psychologist_repository->createPsychologistAddress($psychologist->id, $data['billing']['address']);

        $plan = $this->plan_repository->getByName($data['plan_name'])->first();

        if(!$plan)
            throw new \Exception("O plano não foi localizado", 500);


//        $client_guzlle = new Client();
//        $url_base = env('URL_BASE_PAGARME');
//
//        $item = [
//            'id' => '1',
//            'title' => 'Consulta PSIPLAN BRASIL',
//            'unit_price' => '8500',
//            'quantity' => '1',
//            'tangible' => false,
//        ];
//
//        $receiver_psiplan = [
//            'recipient_id' => env('RECIPIENT_ID'),
//            'percentage' => 10,
//            'liable' => true,
//            'charge_processing_fee' => true,
//        ];
//
//        $receiver_psychologist = [
//            'recipient_id' => 're_ck4g908ky02p5v26f0zgbj0jn',
//            'percentage' => 90,
//            'liable' => true,
//            'charge_processing_fee' => true,
//        ];
//
//        array_push($data['items'], $item);
//        array_push($data['split_rules'], $receiver_psiplan);
//        array_push($data['split_rules'], $receiver_psychologist);
//
//        $data['api_key'] = env('API_KEY_PAGARME');
//        $data['amount'] = '8500';
//        $data['customer']['documents'][0]['number'] = onlyNumber($data['customer']['documents'][0]['number']);
//        $data['customer']['phone_numbers'] = ["+55".onlyNumber($data['customer']['phone_numbers'][0])];
//        $data['customer']['birthday'] = dateEN($data['customer']['birthday']);
//
//        $response = $client_guzlle->post("{$url_base}/transactions", [
//            'headers' => [
//                'Accept'     => 'application/json',
//            ],
//            'json' => $data,
//        ]);
//
//        if($response->getStatusCode() != 200)
//            throw new \Exception("Ocorre um erro no pagamento!", $response->getStatusCode());
//
//        return json_decode($response->getBody()->getContents());
    }
}
