<?php

namespace App\Services\API\v1\Client;


use App\Enums\FirstConsultationStatusEnum;
use App\Enums\NotificationsEnum;
use App\Enums\NotificationsStatusEnum;
use App\Jobs\SendEmailConsultationFreePsychologist;
use App\Jobs\SendEmailConsultationFreeClient;
use App\Repositories\ClientRepository;
use App\Repositories\PsychologistRepository;
use App\Repositories\QueryRepository;
use App\Services\API\v1\User\StoreUserNotificationService;

class RequestConsultationFreeClientService
{
    private $query_repository;
    private $psychologist_repository;
    private $store_user_notification_service;
    private $client_repository;

    public function __construct(
        QueryRepository $query_repository,
        PsychologistRepository $psychologist_repository,
        StoreUserNotificationService $store_user_notification_service,
        ClientRepository $client_repository)
    {
        $this->query_repository = $query_repository;
        $this->psychologist_repository = $psychologist_repository;
        $this->store_user_notification_service = $store_user_notification_service;
        $this->client_repository = $client_repository;
    }

    public function execute($client, $psychologist_id)
    {
        if($client->first_consultation_status == FirstConsultationStatusEnum::STATUS_USED)
            throw new \Exception("Já já solicitou a sua consulta grátis", 500);

        $psychologist = $this->psychologist_repository->find($psychologist_id);

        $data_notification_client = [
            'user_id' => $client->user_id,
            'notification_id' => NotificationsEnum::NOTIFICATION_FIRST_CONSULTATION_FREE['id'],
            'title' => NotificationsEnum::NOTIFICATION_FIRST_CONSULTATION_FREE['title'],
            'description' => NotificationsEnum::NOTIFICATION_FIRST_CONSULTATION_FREE['description'],
            'status' => NotificationsStatusEnum::STATUS_NOT_READ,
            'details' => NotificationsEnum::NOTIFICATION_FIRST_CONSULTATION_FREE['details'],
        ];

        $data_notification_psychologist = [
            'user_id' => $psychologist->user_id,
            'notification_id' => NotificationsEnum::NOTIFICATION_FIRST_CONSULTATION_FREE['id'],
            'title' => NotificationsEnum::NOTIFICATION_FIRST_CONSULTATION_FREE['title'],
            'description' => NotificationsEnum::NOTIFICATION_FIRST_CONSULTATION_FREE['description'],
            'status' => NotificationsStatusEnum::STATUS_NOT_READ,
            'details' => NotificationsEnum::NOTIFICATION_FIRST_CONSULTATION_FREE['details'],
        ];

        $this->store_user_notification_service->execute($data_notification_client);
        $this->store_user_notification_service->execute($data_notification_psychologist);
        $this->client_repository->edit($client, ['first_consultation_status' => FirstConsultationStatusEnum::STATUS_USED]);

        $data = [
            'client_name' => $client->name,
            'client_email' => $client->email,
            'client_phone' => $client->phone,
            'psychologist_name' => $psychologist->name,
            'psychologist_email' => $psychologist->email,
            'psychologist_phone' => $psychologist->phone,
        ];

        SendEmailConsultationFreePsychologist::dispatch($data);
        SendEmailConsultationFreeClient::dispatch($data);
    }
}
