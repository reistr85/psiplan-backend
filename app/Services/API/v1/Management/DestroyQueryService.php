<?php


namespace App\Services\API\v1\Management;


use App\Enums\NotificationsEnum;
use App\Enums\NotificationsStatusEnum;
use App\Mail\QueryCanceledClient;
use App\Repositories\QueryRepository;
use App\Jobs\SendEmailQueryCanceled;
use App\Repositories\UserNotificationRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class DestroyQueryService
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

    public function execute(int $id)
    {
        $query = $this->query_repository->find($id);

        if(!$query)
            throw new \Exception("Consulta não localizada.", 500);

        $query_hour = Carbon::create($query->day_hour);
        $now = Carbon::now();

        if($query_hour->diffInHours($now) < 48)
            throw new \Exception("Esta consulta não pode mais ser cancelada pois está com menos de 48h para sua realização.", 500);

        $data = [
            'name' => $query->client->name,
            'email' => $query->client->email,
        ];

        SendEmailQueryCanceled::dispatch($data);

        $data_user_notification = [
            'user_id' => $query->client->user_id,
            'notification_id' => NotificationsEnum::NOTIFICATION_QUERY_CANCELED_CLIENT['id'],
            'title' => NotificationsEnum::NOTIFICATION_QUERY_CANCELED_CLIENT['title'],
            'description' => NotificationsEnum::NOTIFICATION_QUERY_CANCELED_CLIENT['description'],
            'status' => NotificationsStatusEnum::STATUS_NOT_READ,
            'details' => NotificationsEnum::NOTIFICATION_QUERY_CANCELED_CLIENT['details']
        ];

        $this->user_notification_repository->store($data_user_notification);

        return $this->query_repository->destroy($query);
    }
}
