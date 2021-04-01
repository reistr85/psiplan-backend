<?php

namespace App\Jobs;

use App\Enums\QueryStatusPaymentEnum;
use App\Models\Query;
use App\Repositories\PsychologistAvailabilityCalendarRepository;
use App\Repositories\QueryRepository;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class FreeDayScheduling implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $query;
    private $query_repository;
    private $psychologist_availability_calendar_repository;

    /**
     * Create a new job instance.
     *
     * @param Query $query
     */
    public function __construct(
        Query $query)
    {
        $this->query = $query;
        $this->psychologist_availability_calendar_repository = app(PsychologistAvailabilityCalendarRepository::class);
        $this->query_repository = app(QueryRepository::class);
    }

    /**
     * Execute the job.
     *
     * @return bool
     * @throws Exception
     */
    public function handle()
    {
        if($this->query->payment_status != QueryStatusPaymentEnum::STATUS_PAYMENT_REFUSED)
            return;

        if(!$this->query->payment_status)
            return;

        $psychologist_availability_calendar = $this->psychologist_availability_calendar_repository
            ->find($this->query->psychologist_availability_calendar_id);

        $this->psychologist_availability_calendar_repository->edit($psychologist_availability_calendar, [
            'available' => null
        ]);

        $this->query_repository->destroy($this->query);

        return true;
    }
}
