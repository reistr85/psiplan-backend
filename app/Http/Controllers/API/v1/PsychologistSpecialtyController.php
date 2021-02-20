<?php

namespace App\Http\Controllers\API\v1;

use App\Enums\TypeServiceEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\StoreUserRequest;
use App\Services\API\v1\Psychologist\CreatePsychologistSpecialtyService;
use App\Services\API\v1\Psychologist\GetPsychologistByUserIdService;
use App\Services\API\v1\Psychologist\UpdatePsychologistPercentageProfileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class PsychologistSpecialtyController extends Controller
{
    private $getPsychologistByUserIdService;
    private $createPsychologistSpecialtyService;
    private $update_psychologist_percentage_profile_service;

    public function __construct(
        GetPsychologistByUserIdService $getPsychologistByUserIdService,
        CreatePsychologistSpecialtyService $createPsychologistSpecialtyService,
        UpdatePsychologistPercentageProfileService $update_psychologist_percentage_profile_service)
    {
        $this->getPsychologistByUserIdService = $getPsychologistByUserIdService;
        $this->createPsychologistSpecialtyService = $createPsychologistSpecialtyService;
        $this->update_psychologist_percentage_profile_service = $update_psychologist_percentage_profile_service;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $user = auth()->user();
            $type = 'specialties';
            $psychologist = $user->psychologist;
            $specialties = $request->input('specialties');
            $this->createPsychologistSpecialtyService->execute($psychologist->id, $specialties);
            $percentage_value = TypeServiceEnum::PERCENTAGE_SPECIALTY_VALUE;
            $percentage = $this->update_psychologist_percentage_profile_service->execute($psychologist->id,'add', $type, $percentage_value);

            DB::commit();
            return response()->json(['status' => true, 'message' => 'Especialidades cadastradas com sucesso.', 'percentage' => $percentage], 200);
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['error' => true, 'status' => false, 'message' => $e->getMessage()], $e->getCode());
        }
    }
}
