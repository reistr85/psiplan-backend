<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Services\API\v1\Psychologist\CreatePsychologistDocumentService;
use App\Services\API\v1\Psychologist\GetPsychologistByUserIdService;
use Illuminate\Http\Request;

class PsychologistDocumentController extends Controller
{
    private $getPsychologistByUserIdService;
    private $createPsychologistDocumentService;

    public function __construct(GetPsychologistByUserIdService $getPsychologistByUserIdService, CreatePsychologistDocumentService $createPsychologistDocumentService)
    {
        $this->getPsychologistByUserIdService = $getPsychologistByUserIdService;
        $this->createPsychologistDocumentService = $createPsychologistDocumentService;
    }

    public function store(Request $request)
    {
        try{
            $user = auth()->user();
            $psychologist = $this->getPsychologistByUserIdService->execute($user->id);

            $this->createPsychologistDocumentService->execute($psychologist->id, $request->all());

            return response()->json(['status' => true, 'message' => 'Registro alterado com sucesso'], 200);
        }catch (\Exception $e){
            return response()->json(['error' => true, 'message' => $e->getMessage()], $e->getCode());
        }
    }
}
