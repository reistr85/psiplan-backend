<?php


namespace App\Services\API\v1\Psychologist;


use App\Enums\NotificationsEnum;
use App\Enums\NotificationsStatusEnum;
use App\Models\Evaluation;
use App\Repositories\ClientRepository;
use App\Repositories\EvaluationRepository;
use App\Repositories\PsychologistRepository;
use App\Repositories\QueryRepository;
use App\Repositories\UserNotificationRepository;

class CreateEvaluationPsychologistService extends EvaluationRepository
{
    private $query_repository;
    private $user_notification_repository;

    public function __construct(
        Evaluation $model,
        QueryRepository $query_repository,
        UserNotificationRepository $user_notification_repository)
    {
        parent::__construct($model);

        $this->query_repository = $query_repository;
        $this->user_notification_repository = $user_notification_repository;
    }

    public function execute(array $data_evaluation)
    {
        $query = $this->query_repository->find($data_evaluation['query_id']);

        if(!$query)
            throw new \Exception("A consulta não foi localizada.", 500);

        if($query->client_id != $data_evaluation['client_id'])
            throw new \Exception("O cliente da consulta não corresponde ao cliente que está avaliando.", 500);

        $evaluation = parent::store($data_evaluation);
        $data_user_notification = [
            'user_id' => $query->psychologist->user_id,
            'notification_id' => NotificationsEnum::NOTIFICATION_NEW_EVALUATION_PSYCHOLOGIST['id'],
            'title' => NotificationsEnum::NOTIFICATION_NEW_EVALUATION_PSYCHOLOGIST['title'],
            'description' => NotificationsEnum::NOTIFICATION_NEW_EVALUATION_PSYCHOLOGIST['description'],
            'status' => NotificationsStatusEnum::STATUS_NOT_READ,
            'details' => NotificationsEnum::NOTIFICATION_NEW_EVALUATION_PSYCHOLOGIST['details']
        ];
        $this->user_notification_repository->store($data_user_notification);


        if(!$evaluation)
            throw new \Exception("Ocorreu um erro ao tentar registrar sua avaliação. Tente novamente", 500);

        return $evaluation;
    }
}
