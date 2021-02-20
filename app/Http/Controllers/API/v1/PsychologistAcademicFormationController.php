<?php

namespace App\Http\Controllers\API\v1;

use App\Enums\TypeServiceEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\CreatePsychologistAcademicFormationRequest;
use App\Services\API\v1\Psychologist\DestroyPsychologistAcademicFormationService;
use App\Services\API\v1\Psychologist\GetPsychologistByUserIdService;
use App\Services\API\v1\Psychologist\CreatePsychologistAcademicFormationService;
use App\Services\API\v1\Psychologist\UpdatePsychologistPercentageProfileService;

class PsychologistAcademicFormationController extends Controller
{

    private $createPsychologistAcademicFormationService;
    private $getPsychologistByUserIdService;
    private $destroyPsychologistAcademicFormationService;
    private $update_psychologist_percentage_profile_service;

    public function __construct(
        CreatePsychologistAcademicFormationService $createPsychologistAcademicFormationService,
        GetPsychologistByUserIdService $getPsychologistByUserIdService,
        DestroyPsychologistAcademicFormationService $destroyPsychologistAcademicFormationService,
        UpdatePsychologistPercentageProfileService $update_psychologist_percentage_profile_service)
    {
        $this->createPsychologistAcademicFormationService = $createPsychologistAcademicFormationService;
        $this->getPsychologistByUserIdService = $getPsychologistByUserIdService;
        $this->destroyPsychologistAcademicFormationService = $destroyPsychologistAcademicFormationService;
        $this->update_psychologist_percentage_profile_service = $update_psychologist_percentage_profile_service;
    }

    public function store(CreatePsychologistAcademicFormationRequest $request)
    {
        try{
            $user = auth()->user();
            $type = 'formations';
            $psychologist = $user->psychologist;
            $data = $request->only(['type', 'description', 'institution']);
            $data['psychologist_id'] = $psychologist->id;

            $psychologist_academic_formation = $this->createPsychologistAcademicFormationService->execute($data);
            $percentage_value = TypeServiceEnum::PERCENTAGE_FORMATION_VALUE;
            $percentage = $this->update_psychologist_percentage_profile_service->execute($psychologist->id,'add', $type, $percentage_value);

            return response()->json([
                'status' => true,
                'message' => 'Formação acadência cadastrada com sucesso.',
                'psychologist_academic_formation' => $psychologist_academic_formation,
                'percentage' => $percentage], 200);
        }catch (\Exception $e){
            return response()->json(['error' => true, 'message' => $e->getMessage()], $e->getCode());
        }
    }

    public function destroy($id)
    {
        try{

            $user = auth()->user();
            $psychologist = $this->getPsychologistByUserIdService->execute($user->id);

            $this->destroyPsychologistAcademicFormationService->execute($psychologist->id, $id);

            return response()->json(['status' => true, 'message' => 'Registro excluído com sucesso.'], 200);
        }catch (\Exception $e){
            return response()->json(['error' => true, 'message' => $e->getMessage()], $e->getCode());
        }
    }
}
