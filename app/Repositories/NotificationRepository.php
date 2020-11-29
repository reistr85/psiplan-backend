<?php


namespace App\Repositories;


use App\Models\Notification;

class NotificationRepository extends BaseRepository
{
    private $model;

    public function __construct(Notification $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return parent::findAll($this->model);
    }
}
