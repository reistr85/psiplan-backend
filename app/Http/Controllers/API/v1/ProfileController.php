<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\UpdatePsychologistRequest;
use App\Services\API\v1\Psychologist\GetAcademicFormationsByPsychologistIdService;
use App\Services\API\v1\Psychologist\GetAllSpecialtyService;
use App\Services\API\v1\Psychologist\GetPsychologistByUserIdService;
use App\Services\API\v1\Psychologist\GetPsychologistDocumentService;
use App\Services\API\v1\Psychologist\GetSpecialtiesByPsychologistIdService;
use App\Services\API\v1\Psychologist\UpdatePsychologistService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    private $getAllSpecialtiesService;
    private $getSpecialtiesByPsychologistIdService;
    private $getPsychologistByUserIdService;
    private $getAcademicFormationsByPsychologistIdService;
    private $updatePsychologistService;
    private $getPsychologistDocumentService;

    public function __construct(GetAllSpecialtyService $getAllSpecialtiesService, GetSpecialtiesByPsychologistIdService $getSpecialtiesByPsychologistIdService,
                                GetPsychologistByUserIdService $getPsychologistByUserIdService, GetAcademicFormationsByPsychologistIdService $getAcademicFormationsByPsychologistIdService,
                                UpdatePsychologistService $updatePsychologistService, GetPsychologistDocumentService $getPsychologistDocumentService)
    {
        $this->getAllSpecialtiesService = $getAllSpecialtiesService;
        $this->getSpecialtiesByPsychologistIdService = $getSpecialtiesByPsychologistIdService;
        $this->getPsychologistByUserIdService = $getPsychologistByUserIdService;
        $this->getAcademicFormationsByPsychologistIdService = $getAcademicFormationsByPsychologistIdService;
        $this->updatePsychologistService = $updatePsychologistService;
        $this->getPsychologistDocumentService = $getPsychologistDocumentService;
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
            $psychologist_document = $this->getPsychologistDocumentService->execute($psychologist->id);

            return response()->json([
                'status' => true,
                'message' => 'Successfully',
                'user' => $user,
                'psychologist' => $psychologist,
                'specialties' => $specialties,
                'psychologist_specialities' => $psychologist_specialties,
                'psychologist_academic_formations' => $psychologist_academic_formations,
                'psychologist_document' => $psychologist_document,
            ], 200);
        }catch (\Exception $e){
            return response()->json(['error' => true, 'message' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param $action
     * @param Request $request
     * @return JsonResponse
     */
    public function update(UpdatePsychologistRequest $request, $action = null)
    {
        try{
            $user = auth()->user();
            $psychologist = $this->getPsychologistByUserIdService->execute($user->id);
            $data = $request->all();

            $image = $this->updatePsychologistService->execute($psychologist, $data, $action);

            return response()->json(['status' => true, 'message' => 'Registro alterado com sucesso', 'image' => $image], 200);
        }catch (\Exception $e){
            return response()->json(['error' => true, 'message' => $e->getMessage()], $e->getCode());
        }
    }
}
