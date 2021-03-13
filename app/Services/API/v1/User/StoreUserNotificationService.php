<?php


namespace App\Services\API\v1\User;


use App\Repositories\UserNotificationRepository;

class StoreUserNotificationService
{
    private $user_notification_repository;

    public function __construct(
        UserNotificationRepository $user_notification_repository)
    {
        $this->user_notification_repository = $user_notification_repository;
    }

    public function execute(array $data)
    {
        $this->user_notification_repository->store($data);
    }
}
