<?php

namespace App\Jobs;

use App\Models\Psychologist;
use App\Repositories\PsychologistPlanRepository;
use App\Repositories\PsychologistRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DisablePsychologistPlan implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $psychologist;
    private $psychologist_repository;
    private $psychologist_plan_repository;

    /**
     * Create a new job instance.
     *
     * @param Psychologist $psychologist
     */
    public function __construct(Psychologist $psychologist)
    {
        $this->psychologist = $psychologist;
        $this->psychologist_repository = app(PsychologistRepository::class);
        $this->psychologist_plan_repository = app(PsychologistPlanRepository::class);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->psychologist_repository->edit($this->psychologist, ['plan_id' => null]);

        $psychologist_plans =$this->psychologist_plan_repository->allByPsychologistId($this->psychologist->id);
        $psychologist_availability_calendar =$this->psychologist_repository
            ->getPsychologistAvailabilityCalendarAndAvailabilityNull($this->psychologist->id);

        $psychologist_plans->delete();
        $psychologist_availability_calendar->delete();
    }
}
