<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\CreatePsychologistAcademicFormationRequest;
use App\Services\API\v1\Psychologist\PsychologistAcademicFormationService;
use Illuminate\Http\Request;

class PsychologistAcademicFormationController extends Controller
{

    private $createPsychologistAcademicFormationService;

    public function __construct(PsychologistAcademicFormationService $createPsychologistAcademicFormationService)
    {
        $this->createPsychologistAcademicFormationService = $createPsychologistAcademicFormationService;
    }

    public function store(CreatePsychologistAcademicFormationRequest $request)
    {
        try{

            $data = $request->only(['type', 'description', 'institution']);
            $this->createPsychologistAcademicFormationService->execute($data);

            return response()->json(['status' => true, 'message' => 'Successfully', 'data' => $data], 200);
        }catch (\Exception $e){
            return response()->json(['error' => true, 'message' => $e->getMessage()], $e->getCode());
        }
    }
}
