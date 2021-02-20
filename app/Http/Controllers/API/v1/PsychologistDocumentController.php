<?php

namespace App\Http\Controllers\API\v1;

use App\Enums\TypeServiceEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\CreatePsychologistDocumentRequest;
use App\Services\API\v1\Psychologist\CreatePsychologistDocumentService;
use App\Services\API\v1\Psychologist\GetPsychologistByUserIdService;
use App\Services\API\v1\Psychologist\UpdatePsychologistPercentageProfileService;

class PsychologistDocumentController extends Controller
{
    private $getPsychologistByUserIdService;
    private $createPsychologistDocumentService;
    private $update_psychologist_percentage_profile_service;

    public function __construct(
        GetPsychologistByUserIdService $getPsychologistByUserIdService,
        CreatePsychologistDocumentService $createPsychologistDocumentService,
        UpdatePsychologistPercentageProfileService $update_psychologist_percentage_profile_service)
    {
        $this->getPsychologistByUserIdService = $getPsychologistByUserIdService;
        $this->createPsychologistDocumentService = $createPsychologistDocumentService;
        $this->update_psychologist_percentage_profile_service = $update_psychologist_percentage_profile_service;
    }

    public function store(CreatePsychologistDocumentRequest $request)
    {
        try{
            $user = auth()->user();
            $psychologist = $user->psychologist;
            $data = $request->all();
            $type = null;
            $value_percentage = 0;
            $this->createPsychologistDocumentService->execute($psychologist->id, $data);

            if(array_key_exists( 'crp', $data)) {
                $type = 'crp';
                $value_percentage = TypeServiceEnum::PERCENTAGE_DOC_CRP_VALUE;
            }

            if(array_key_exists( 'address', $data)) {
                $type = 'address';
                $value_percentage = TypeServiceEnum::PERCENTAGE_DOC_CRP_VALUE;
            }

            if(array_key_exists( 'certificate_crp', $data)) {
                $type = 'certificate_crp';
                $value_percentage = TypeServiceEnum::PERCENTAGE_DOC_CERTIFICATE_VALUE;
            }

            if(array_key_exists( 'epsi', $data)) {
                $type = 'epsi';
                $value_percentage = TypeServiceEnum::PERCENTAGE_DOC_EPSI_VALUE;
            }

            $percentage = $this->update_psychologist_percentage_profile_service->execute($psychologist->id,'add', $type, $value_percentage);

            return response()->json(['status' => true, 'message' => 'Os arquivos foram enviados com sucesso.', 'percentage' => $percentage], 200);
        }catch (\Exception $e){
            return response()->json(['error' => true, 'message' => $e->getMessage()], $e->getCode());
        }
    }
}
