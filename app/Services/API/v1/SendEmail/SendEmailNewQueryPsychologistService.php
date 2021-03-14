<?php


namespace App\Services\API\v1\SendEmail;

use App\Jobs\SendEmailNewQueryPsychologist;
use App\Mail\NewQueryClient;
use App\Mail\NewQueryPsychologist;
use App\Repositories\QueryRepository;
use Illuminate\Support\Facades\Mail;
use stdClass;

class SendEmailNewQueryPsychologistService
{
    private $query_repository;

    public function __construct(
        QueryRepository $query_repository)
    {
        $this->query_repository = $query_repository;
    }

    public function execute($query_id)
    {
        $query = $this->query_repository->find($query_id);

        if(!$query)
            return false;

        $data = new stdClass();
        $data =  [
            'email' => $query->psychologist->email,
            'name' => $query->psychologist->name,
            'client_name' => $query->client->name,
            'client_contact' => maskPhone($query->client->phone),
            'type_service' => $query->psychologistAvailabilityCalendar->typeService->description,
            'date_query' => dateInFull($query->day_hour),
            'hour_query' => hour($query->day_hour),
        ];

        if($query->videoPlatform)
            $data['video_platform'] = $query->videoPlatform->description;

        if($data['type_service'] == 'Presencial') {
            $data['state'] = $query->psychologist->serviceAddress->state;
            $data['city'] = $query->psychologist->serviceAddress->city;
            $data['neighborhood'] = $query->psychologist->serviceAddress->neighborhood;
            $data['street'] = $query->psychologist->serviceAddress->street;
            $data['number'] = $query->psychologist->serviceAddress->number;
            $data['complement'] = $query->psychologist->serviceAddress->complement;
        }

        SendEmailNewQueryPsychologist::dispatch($data);
    }
}
