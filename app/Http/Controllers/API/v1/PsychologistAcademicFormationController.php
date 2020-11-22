<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\CreatePsychologistAcademicFormationRequest;
use App\Services\API\v1\Psychologist\DestroyPsychologistAcademicFormationService;
use App\Services\API\v1\Psychologist\GetPsychologistByUserIdService;
use App\Services\API\v1\Psychologist\CreatePsychologistAcademicFormationService;
use Illuminate\Http\Request;

class PsychologistAcademicFormationController extends Controller
{

    private $createPsychologistAcademicFormationService;
    private $getPsychologistByUserIdService;
    private $destroyPsychologistAcademicFormationService;

    public function __construct(CreatePsychologistAcademicFormationService $createPsychologistAcademicFormationService,
                                GetPsychologistByUserIdService $getPsychologistByUserIdService,
                                DestroyPsychologistAcademicFormationService $destroyPsychologistAcademicFormationService)
    {
        $this->createPsychologistAcademicFormationService = $createPsychologistAcademicFormationService;
        $this->getPsychologistByUserIdService = $getPsychologistByUserIdService;
        $this->destroyPsychologistAcademicFormationService = $destroyPsychologistAcademicFormationService;
    }

    public function store(CreatePsychologistAcademicFormationRequest $request)
    {
        try{

            $user = auth()->user();
            $psychologist = $this->getPsychologistByUserIdService->execute($user->id);

            $data = $request->only(['type', 'description', 'institution']);
            $data['psychologist_id'] = $psychologist->id;

            $psychologist_academic_formation = $this->createPsychologistAcademicFormationService->execute($data);

            return response()->json(['status' => true, 'message' => 'Formação acadência cadastrada com sucesso.', 'psychologist_academic_formation' => $psychologist_academic_formation], 200);
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
