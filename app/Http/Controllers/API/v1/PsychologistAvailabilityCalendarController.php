<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Services\API\v1\Psychologist\CreatePsychologistAvailabilityCalendarService;
use App\Services\API\v1\Psychologist\DestroyAllHoursDaySelectedPsychologistAvailabilityCalendarService;
use App\Services\API\v1\Psychologist\DestroyAllPsychologistAvailabilityCalendarService;
use App\Services\API\v1\Psychologist\DestroyPsychologistAvailabilityCalendarService;
use App\Services\API\v1\Psychologist\GetPsychologistAvailabilityCalendarByPsychologistIdByTypeServiceIdService;
use App\Services\API\v1\Psychologist\GetPsychologistAvailabilityCalendarByPsychologistIdService;
use App\Services\API\v1\Psychologist\GetPsychologistByUserIdService;
use App\Services\API\v1\Psychologist\GetServiceHoursByDateByPsychologistIdService;
use Illuminate\Http\Request;

class PsychologistAvailabilityCalendarController extends Controller
{
    private $getPsychologistByUserIdService;
    private $createPsychologistAvailabilityCalendarService;
    private $getPsychologistAvailabilityCalendarByPsychologistIdService;
    private $getServiceHoursByDateByPsychologistIdService;
    private $destroyPsychologistAvailabilityCalendarService;
    private $destroyAllPsychologistAvailabilityCalendarService;
    private $destroyAllHoursDaySelectedPsychologistAvailabilityCalendarService;

    public function __construct(
        GetPsychologistByUserIdService $getPsychologistByUserIdService,
        CreatePsychologistAvailabilityCalendarService $createPsychologistAvailabilityCalendarService,
        GetPsychologistAvailabilityCalendarByPsychologistIdService $getPsychologistAvailabilityCalendarByPsychologistIdService,
        GetServiceHoursByDateByPsychologistIdService $getServiceHoursByDateByPsychologistIdService,
        DestroyPsychologistAvailabilityCalendarService $destroyPsychologistAvailabilityCalendarService,
        DestroyAllPsychologistAvailabilityCalendarService $destroyAllPsychologistAvailabilityCalendarService,
        DestroyAllHoursDaySelectedPsychologistAvailabilityCalendarService $destroyAllHoursDaySelectedPsychologistAvailabilityCalendarService)
    {
        $this->getPsychologistByUserIdService = $getPsychologistByUserIdService;
        $this->createPsychologistAvailabilityCalendarService = $createPsychologistAvailabilityCalendarService;
        $this->getPsychologistAvailabilityCalendarByPsychologistIdService = $getPsychologistAvailabilityCalendarByPsychologistIdService;
        $this->getServiceHoursByDateByPsychologistIdService = $getServiceHoursByDateByPsychologistIdService;
        $this->destroyPsychologistAvailabilityCalendarService = $destroyPsychologistAvailabilityCalendarService;
        $this->destroyAllPsychologistAvailabilityCalendarService = $destroyAllPsychologistAvailabilityCalendarService;
        $this->destroyAllHoursDaySelectedPsychologistAvailabilityCalendarService = $destroyAllHoursDaySelectedPsychologistAvailabilityCalendarService;
    }

    public function index(Request $request)
    {
        try{
            $user = auth()->user();
            $psychologist = $this->getPsychologistByUserIdService->execute($user->id);
            $appointments_available = $this->getPsychologistAvailabilityCalendarByPsychologistIdService->execute($psychologist->id);

            return response()->json(['status' => true, 'message' => 'Successfully', 'appointments_available' => $appointments_available], 200);
        }catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], $e->getCode());
        }
    }

    public function store(Request $request)
    {
        try{
            $user = auth()->user();
            $psychologist = $this->getPsychologistByUserIdService->execute($user->id);
            $data = $request->all();

            $this->createPsychologistAvailabilityCalendarService->execute($psychologist->id, $data);

            return response()->json(['status' => true, 'message' => 'Registros salvo com sucesso!'], 200);
        }catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], $e->getCode());
        }
    }

    public function destroy($id)
    {
        try{
            $user = auth()->user();
            $psychologist = $this->getPsychologistByUserIdService->execute($user->id);

            $this->destroyPsychologistAvailabilityCalendarService->execute($psychologist->id, $id);

            return response()->json(['status' => true, 'message' => 'Registros deletedo com sucesso!'], 200);
        }catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], $e->getCode());
        }
    }

    public function destroyAll(Request $request)
    {
        try{
            $user = auth()->user();
            $psychologist = $this->getPsychologistByUserIdService->execute($user->id);

            $this->destroyAllPsychologistAvailabilityCalendarService->execute($psychologist);

            return response()->json(['status' => true, 'message' => 'Registros deletedo com sucesso!'], 200);
        }catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], $e->getCode());
        }
    }

    public function destroyAllDaySelected(Request $request)
    {
        try{
            $user = auth()->user();
            $psychologist = $this->getPsychologistByUserIdService->execute($user->id);
            $day_selected = $request->input('day_selected');

            $this->destroyAllHoursDaySelectedPsychologistAvailabilityCalendarService->execute($psychologist->id, $day_selected);

            return response()->json(['status' => true, 'message' => 'Registros deletedo com sucesso!'], 200);
        }catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], $e->getCode());
        }
    }

    public function getServiceHours(Request $request)
    {
        try{
            $user = auth()->user();
            $psychologist = $this->getPsychologistByUserIdService->execute($user->id);
            $data = $request->only('date', 'type_service_id');

            $hours = $this->getServiceHoursByDateByPsychologistIdService->execute($psychologist->id, $data);

            return response()->json(['status' => true, 'message' => 'Successfully', 'hours' => $hours], 200);
        }catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], $e->getCode());
        }
    }
}
