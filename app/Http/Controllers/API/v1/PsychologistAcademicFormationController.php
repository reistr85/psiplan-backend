<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\CreatePsychologistAcademicFormationRequest;
use App\Services\API\v1\Psychologist\GetPsychologistByUserIdService;
use App\Services\API\v1\Psychologist\PsychologistAcademicFormationService;
use Illuminate\Http\Request;

class PsychologistAcademicFormationController extends Controller
{

    private $createPsychologistAcademicFormationService;
    private $getPsychologistByUserIdService;

    public function __construct(PsychologistAcademicFormationService $createPsychologistAcademicFormationService, GetPsychologistByUserIdService $getPsychologistByUserIdService)
    {
        $this->createPsychologistAcademicFormationService = $createPsychologistAcademicFormationService;
        $this->getPsychologistByUserIdService = $getPsychologistByUserIdService;
    }

    public function store(CreatePsychologistAcademicFormationRequest $request)
    {
        try{

            $user = auth()->user();
            $psychologist = $this->getPsychologistByUserIdService->execute($user->id);

            $data = $request->only(['type', 'description', 'institution']);
            $data['psychologist_id'] = $psychologist->id;

            $psychologist_academic_formation = $this->createPsychologistAcademicFormationService->execute($data);

            return response()->json(['status' => true, 'message' => 'Successfully', 'psychologist_academic_formation' => $psychologist_academic_formation], 200);
        }catch (\Exception $e){
            return response()->json(['error' => true, 'message' => $e->getMessage()], $e->getCode());
        }
    }
}
