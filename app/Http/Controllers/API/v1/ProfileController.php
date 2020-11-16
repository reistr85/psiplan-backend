<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Services\API\v1\Psychologist\GetAllSpecialtiesService;
use App\Services\API\v1\Psychologist\GetPsychologistByUserIdService;
use App\Services\API\v1\Psychologist\GetSpecialtiesByPsychologistIdService;
use http\Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    private $getAllSpecialtiesService;
    private $getSpecialtiesByPsychologistIdService;
    private $getPsychologistByUserIdService;

    public function __construct(GetAllSpecialtiesService $getAllSpecialtiesService, GetSpecialtiesByPsychologistIdService $getSpecialtiesByPsychologistIdService,
                                GetPsychologistByUserIdService $getPsychologistByUserIdService)
    {
        $this->getAllSpecialtiesService = $getAllSpecialtiesService;
        $this->getSpecialtiesByPsychologistIdService = $getSpecialtiesByPsychologistIdService;
        $this->getPsychologistByUserIdService = $getPsychologistByUserIdService;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        try{
            $user = auth()->user();
            $psychologist = $this->getPsychologistByUserIdService->execute($user->id);

            $specialties = $this->getAllSpecialtiesService->execute();
            $psychologist_specialties = $this->getSpecialtiesByPsychologistIdService->execute($psychologist->id);

            return response()->json([
                'status' => true,
                'message' => 'Successfully',
                'specialties' => $specialties,
                'psychologist_specialities' => $psychologist_specialties
            ], 200);
        }catch (Exception $e){
            return response()->json(['error' => true, 'message' => $e->getMessage()], $e->getCode());
        }
    }
}
