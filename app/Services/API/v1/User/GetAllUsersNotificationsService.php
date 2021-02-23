<?php


namespace App\Services\API\v1\User;


use App\Repositories\UserNotificationRepository;
use App\User;

class GetAllUsersNotificationsService
{
    private $user_notification_repository;

    public function __construct(
        UserNotificationRepository $user_notification_repository)
    {
        $this->user_notification_repository = $user_notification_repository;
    }

    public function execute(User $user)
    {
        if(!$user)
            throw new \Exception("Usuário não localizado", 500);

        return $this->user_notification_repository->getAllNotReadByUserId($user->id)->get();
    }
}
