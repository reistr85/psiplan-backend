<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Services\API\v1\Psychologist\CreatePsychologistAvailabilityCalendarService;
use App\Services\API\v1\Psychologist\GetPsychologistAvailabilityCalendarByPsychologistIdService;
use App\Services\API\v1\Psychologist\GetPsychologistByUserIdService;
use Illuminate\Http\Request;

class PsychologistAvailabilityCalendarController extends Controller
{
    private $getPsychologistByUserIdService;
    private $createPsychologistAvailabilityCalendarService;
    private $getPsychologistAvailabilityCalendarByPsychologistIdService;

    public function __construct(
        GetPsychologistByUserIdService $getPsychologistByUserIdService,
        CreatePsychologistAvailabilityCalendarService $createPsychologistAvailabilityCalendarService,
        GetPsychologistAvailabilityCalendarByPsychologistIdService $getPsychologistAvailabilityCalendarByPsychologistIdService)
    {
        $this->getPsychologistByUserIdService = $getPsychologistByUserIdService;
        $this->createPsychologistAvailabilityCalendarService = $createPsychologistAvailabilityCalendarService;
        $this->getPsychologistAvailabilityCalendarByPsychologistIdService = $getPsychologistAvailabilityCalendarByPsychologistIdService;
    }

    public function index(Request $request)
    {
        try{
            $user = auth()->user();
            $psychologist = $this->getPsychologistByUserIdService->execute($user->id);
            $appointments_available = $this->getPsychologistAvailabilityCalendarByPsychologistIdService->execute($psychologist->id);

            return response()->json(['status' => true, 'message' => 'Successfully!', 'appointments_available' => $appointments_available], 200);
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
}
