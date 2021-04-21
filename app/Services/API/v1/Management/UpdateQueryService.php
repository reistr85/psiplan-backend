<?php


namespace App\Services\API\v1\Management;


use App\Enums\NotificationsEnum;
use App\Enums\NotificationsStatusEnum;
use App\Enums\QueryStatusEnum;
use App\Repositories\QueryRepository;
use App\Jobs\SendEmailEvaluationQuery;
use App\Repositories\UserNotificationRepository;

class UpdateQueryService
{
    private $query_repository;
    private $user_notification_repository;

    public function __construct(
        QueryRepository $query_repository,
        UserNotificationRepository $user_notification_repository)
    {
        $this->query_repository = $query_repository;
        $this->user_notification_repository = $user_notification_repository;
    }

    public function execute(int $id, array $data)
    {
        $query = $this->query_repository->find($id);

        if(!$query)
            throw new \Exception("Consulta não localizada.", 500);

        if($data['status_query'] ==  QueryStatusEnum::STATUS_QUERY_FULFILLED){
            $client = $query->client;
            $dataEmail = ['name' => $client->name, 'email' => $client->email];
            SendEmailEvaluationQuery::dispatch($dataEmail);

            $data_user_notification = [
                'user_id' => $query->client->user_id,
                'notification_id' => NotificationsEnum::NOTIFICATION_NEW_EVALUATION_CLIENT['id'],
                'title' => NotificationsEnum::NOTIFICATION_NEW_EVALUATION_CLIENT['title'],
                'description' => NotificationsEnum::NOTIFICATION_NEW_EVALUATION_CLIENT['description'],
                'status' => NotificationsStatusEnum::STATUS_NOT_READ,
                'details' => NotificationsEnum::NOTIFICATION_NEW_EVALUATION_CLIENT['details']
            ];

            $this->user_notification_repository->store($data_user_notification);
        }

        return $this->query_repository->edit($query, $data);
    }
}
