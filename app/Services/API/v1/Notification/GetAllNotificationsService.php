<?php


namespace App\Services\API\v1\Notification;


use App\Repositories\NotificationRepository;

class GetAllNotificationsService extends NotificationRepository
{
    public function execute()
    {
        return parent::all();
    }
}
