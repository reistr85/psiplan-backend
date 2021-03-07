<?php


namespace App\Services\API\v1\User;


use App\Repositories\UserNotificationRepository;
use App\User;

class UpdateStatusUserNotificationService
{
    private $user_notification_repository;

    public function __construct(
        UserNotificationRepository $user_notification_repository)
    {
        $this->user_notification_repository = $user_notification_repository;
    }

    public function execute(int $id, array $data)
    {
        $user_notification = $this->user_notification_repository->find($id);

        if(!$user_notification)
            throw new \Exception("Notificação não localizada", 500);

        return $this->user_notification_repository->edit($user_notification, $data);
    }
}
