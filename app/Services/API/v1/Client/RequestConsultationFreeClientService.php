<?php


namespace App\Services\API\v1\Client;


use App\Enums\FirstConsultationStatusEnum;
use App\Mail\ConsultationFreeClient;
use App\Mail\ConsultationFreePsychologist;
use App\Repositories\PsychologistRepository;
use App\Repositories\QueryRepository;
use App\Services\API\v1\User\StoreUserNotificationService;
use Illuminate\Support\Facades\Mail;

class RequestConsultationFreeClientService
{
    private $query_repository;
    private $psychologist_repository;
    private $store_user_notification_service;

    public function __construct(
        QueryRepository $query_repository,
        PsychologistRepository $psychologist_repository,
        StoreUserNotificationService $store_user_notification_service)
    {
        $this->query_repository = $query_repository;
        $this->psychologist_repository = $psychologist_repository;
        $this->store_user_notification_service = $store_user_notification_service;
    }

    public function execute($client, $psychologist_id)
    {
        if($client->first_consultation_status == FirstConsultationStatusEnum::STATUS_USED)
            throw new \Exception("Já já solicitou a sua consulta grátis", 500);

        $psychologist = $this->psychologist_repository->find($psychologist_id);

        $data = [
            'client_name' => $client->name,
            'client_email' => $client->email,
            'client_phone' => $client->phone,
            'psychologist_name' => $psychologist->name,
            'psychologist_email' => $psychologist->email,
            'psychologist_phone' => $psychologist->phone,
        ];

        Mail::send(new ConsultationFreeClient($data));
        Mail::send(new ConsultationFreePsychologist($data));

        //send notification
        $data_notification_client = [
            'user_id' => '',
            'type_user' => '',
            'notification_id' => '',
            'title' => '',
            'description' => '',
            'url' => '',
            'status' => '',
            'url_children' => '',
        ];

        $this->store_user_notification_service->execute('');



    }
}
