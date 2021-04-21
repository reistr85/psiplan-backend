<?php


namespace App\Services\API\v1\PaymentPlanPsychologist;


use App\Enums\TypeServiceEnum;
use App\Repositories\PsychologistPlanRepository;
use App\Repositories\PagarmeSubscriptionRepository;
use App\Repositories\PlanRepository;
use App\Repositories\PsychologistRepository;
use App\Repositories\PsychologistTypeServiceRepository;
use App\Services\API\v1\Psychologist\DeleteAllAvailabilityCalendarByPsychologistIdAndTypeServiceIdService;
use App\Jobs\SendEmailUpdatePlan;
use GuzzleHttp\Client;

class UpdatePagarmePlanPsychologistService
{

    private $plan_repository;
    private $psychologist_repository;
    private $pagarme_subscription_repository;
    private $delete_all_availability_calendar_by_psychologist_id_by_type_service_id_service;
    private $psychologist_plan_repository;
    private $psychologist_type_services_repository;

    public function __construct(
        PlanRepository $plan_repository, PsychologistRepository $psychologist_repository,
        PagarmeSubscriptionRepository $pagarme_subscription_repository,
        DeleteAllAvailabilityCalendarByPsychologistIdAndTypeServiceIdService
        $delete_all_availability_calendar_by_psychologist_id_by_type_service_id_service,
        PsychologistPlanRepository $psychologist_plan_repository,
        PsychologistTypeServiceRepository $psychologist_type_services_repository)
    {
        $this->plan_repository = $plan_repository;
        $this->psychologist_repository = $psychologist_repository;
        $this->pagarme_subscription_repository = $pagarme_subscription_repository;
        $this->delete_all_availability_calendar_by_psychologist_id_by_type_service_id_service =
            $delete_all_availability_calendar_by_psychologist_id_by_type_service_id_service;
        $this->psychologist_plan_repository = $psychologist_plan_repository;
        $this->psychologist_type_services_repository = $psychologist_type_services_repository;
    }

    public function execute($pagarme_subscription, $plan_name)
    {
        $psychologist = auth()->user()->psychologist;
        $plan = $this->plan_repository->getByName($plan_name)->first();

        if(!$plan)
            throw new \Exception("O plano não foi localizado", 500);

        if(explode('-', $plan->name)[1] != explode('-', $psychologist->plan->name)[1])
            throw new \Exception("Não é possível alterar para o plano escolhido", 500);

        $client_guzlle = new Client();
        $url_base = env('URL_BASE_PAGARME');

        $data['api_key'] = env('API_KEY_PAGARME');
        $data['plan_id'] = $plan->pagarme_plan_id;

        $response = $client_guzlle->put("{$url_base}/subscriptions/{$pagarme_subscription->subscription_id}", [
            'headers' => [
                'Accept'     => 'application/json',
            ],
            'json' => $data,
        ]);

        if($response->getStatusCode() != 200)
            throw new \Exception("Ocorre um erro ao atualizar o plano!", $response->getStatusCode());

        $this->pagarme_subscription_repository->edit($pagarme_subscription, ['plan_id' => $plan->id]);
        $psychologist_plans = $this->psychologist_plan_repository->allByPsychologistId($psychologist->id);
        $psychologist_plans->delete();

        $psychologist_plan = [
            'psychologist_id' => $psychologist->id,
            'plan_id' => $plan->id,
            'is_active' => '1',
        ];

        $this->psychologist_plan_repository->store($psychologist_plan);

        $data_psychologist = [
            'plan_id' => $plan->id,
        ];


        if($plan->id == TypeServiceEnum::PLAN_ID_SIMPLE_TRI || $plan->id == TypeServiceEnum::PLAN_ID_SIMPLE_SEM) {
            $this->delete_all_availability_calendar_by_psychologist_id_by_type_service_id_service
                ->execute($psychologist->id, TypeServiceEnum::TYPE_SERVICE_ONLINE);

            $data_psychologist['consultation_package'] = null;
            $data_psychologist['consultation_package_value'] = null;

            //REMOVER TYPE_SERVICE_ONLINE
            $psychologist_type_service =
                $this->psychologist_type_services_repository
                    ->getPsychologistTypeServiceByTypeServiceIdByPsychologistId(
                        $psychologist->id,
                        TypeServiceEnum::TYPE_SERVICE_ONLINE)
                    ->first();

            $this->psychologist_type_services_repository->destroy($psychologist_type_service);
        }

        if($plan->id == TypeServiceEnum::PLAN_ID_ECONOMIC_TRI || $plan->id == TypeServiceEnum::PLAN_ID_ECONOMIC_SEM) {
            $data_psychologist['consultation_package'] = null;
            $data_psychologist['consultation_package_value'] = null;
        }

        $this->psychologist_repository->edit($psychologist, $data_psychologist);

        $data_email = [
            'name' => $psychologist->name,
            'email' => $psychologist->email,
        ];

        SendEmailUpdatePlan::dispatch($data_email);
        $response = json_decode($response->getBody()->getContents());

        return $response;

    }
}
