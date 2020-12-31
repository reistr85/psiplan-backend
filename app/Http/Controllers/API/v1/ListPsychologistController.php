<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Services\API\v1\Psychologist\GetPsychologistAvailabilityCalendarByPsychologistIdService;
use App\Services\API\v1\Psychologist\GetPsychologistByUserIdService;
use App\Services\API\v1\Psychologist\ListPsychologistService;
use Illuminate\Http\Request;

class ListPsychologistController extends Controller
{
    private $listPsychologistService;
    private $getPsychologistByUserIdService;
    private $getPsychologistAvailabilityCalendarByPsychologistIdService;

    public function __construct(
        ListPsychologistService $listPsychologistService,
        GetPsychologistAvailabilityCalendarByPsychologistIdService $getPsychologistAvailabilityCalendarByPsychologistIdService,
        GetPsychologistByUserIdService $getPsychologistByUserIdService)
    {
        $this->listPsychologistService = $listPsychologistService;
        $this->getPsychologistByUserIdService = $getPsychologistByUserIdService;
        $this->getPsychologistAvailabilityCalendarByPsychologistIdService = $getPsychologistAvailabilityCalendarByPsychologistIdService;
    }

    public function index(Request $request)
    {
        try{
            $params = $request->only(['text', 'city_id', 'target_audience_id', 'genre_id', 'order_price', 'specialty_id', 'language_id']);
            $return = $this->listPsychologistService->index($params);

            return response()->json($return, 200);
        }catch(\Exception $e){
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }

    public function getFilters(Request $request)
    {
        try{
            $return = $this->listPsychologistService->getFilters();

            return response()->json($return, 200);
        }catch(\Exception $e){
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try{
            $psychologist = $this->getPsychologistByUserIdService->execute($id);

            return response()->json([
                'status' => true,
                'message' => 'Successfully',
                'psychologist' => $psychologist,
            ], 200);
        }catch(\Exception $e){
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }

    public function getPsychologistAvailability($id)
    {
        try{
            $appointments_available = $this->getPsychologistAvailabilityCalendarByPsychologistIdService->execute($id);

            return response()->json([
                'status' => true,
                'message' => 'Successfully',
                'appointments_available' => $appointments_available,
            ], 200);
        }catch(\Exception $e){
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }
}
