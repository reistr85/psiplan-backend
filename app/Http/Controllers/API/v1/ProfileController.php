<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Services\API\v1\Psychologist\GetAcademicFormationsByPsychologistIdService;
use App\Services\API\v1\Psychologist\GetAllSpecialtiesService;
use App\Services\API\v1\Psychologist\GetPsychologistByUserIdService;
use App\Services\API\v1\Psychologist\GetSpecialtiesByPsychologistIdService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    private $getAllSpecialtiesService;
    private $getSpecialtiesByPsychologistIdService;
    private $getPsychologistByUserIdService;
    private $getAcademicFormationsByPsychologistIdService;

    public function __construct(GetAllSpecialtiesService $getAllSpecialtiesService, GetSpecialtiesByPsychologistIdService $getSpecialtiesByPsychologistIdService,
                                GetPsychologistByUserIdService $getPsychologistByUserIdService, GetAcademicFormationsByPsychologistIdService $getAcademicFormationsByPsychologistIdService)
    {
        $this->getAllSpecialtiesService = $getAllSpecialtiesService;
        $this->getSpecialtiesByPsychologistIdService = $getSpecialtiesByPsychologistIdService;
        $this->getPsychologistByUserIdService = $getPsychologistByUserIdService;
        $this->getAcademicFormationsByPsychologistIdService = $getAcademicFormationsByPsychologistIdService;
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
            $psychologist_academic_formations = $this->getAcademicFormationsByPsychologistIdService->execute($psychologist->id);

            return response()->json([
                'status' => true,
                'message' => 'Successfully',
                'user' => $user,
                'psychologist' => $psychologist,
                'specialties' => $specialties,
                'psychologist_specialities' => $psychologist_specialties,
                'psychologist_academic_formations' => $psychologist_academic_formations
            ], 200);
        }catch (\Exception $e){
            return response()->json(['error' => true, 'message' => $e->getMessage()], $e->getCode());
        }
    }
}
