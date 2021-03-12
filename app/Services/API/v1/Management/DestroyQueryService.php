<?php


namespace App\Services\API\v1\Management;


use App\Mail\QueryCanceledClient;
use App\Repositories\QueryRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class DestroyQueryService
{
    private $query_repository;

    public function __construct(
        QueryRepository $query_repository)
    {
        $this->query_repository = $query_repository;
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

        Mail::send(new QueryCanceledClient($data));

        return $this->query_repository->destroy($query);
    }
}
