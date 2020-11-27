<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Services\API\v1\City\GetAllCitiesService;
use App\Services\API\v1\City\GetCitiesByStateService;
use App\Services\API\v1\Psychologist\GetPsychologistByUserIdService;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    private $getPsychologistByUserIdService;
    private $getByState;

    public function __construct(GetPsychologistByUserIdService $getPsychologistByUserIdService, GetCitiesByStateService $getByState)
    {
        $this->getPsychologistByUserIdService = $getPsychologistByUserIdService;
        $this->getByState = $getByState;
    }

    public function index()
    {
        try{
            $user = auth()->user();
            $psychologist = $this->getPsychologistByUserIdService->execute($user->id);
            $cities = $this->getByState->execute('RN');

            return response()->json(['status' => true, 'message' => 'Successfully', 'psychologist' => $psychologist, 'cities' => $cities], 200);
        }catch(\Exception $e){
            return response()->json(['error' => true, 'status' => false, 'message' => $e->getMessage()], $e->getCode());
        }
    }
}
