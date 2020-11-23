<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\StoreUserRequest;
use App\Services\API\v1\Psychologist\CreatePsychologistSpecialtyService;
use App\Services\API\v1\Psychologist\GetPsychologistByUserIdService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class PsychologistSpecialtyController extends Controller
{
    private $getPsychologistByUserIdService;
    private $createPsychologistSpecialtyService;

    public function __construct(GetPsychologistByUserIdService $getPsychologistByUserIdService, CreatePsychologistSpecialtyService $createPsychologistSpecialtyService)
    {
        $this->getPsychologistByUserIdService = $getPsychologistByUserIdService;
        $this->createPsychologistSpecialtyService = $createPsychologistSpecialtyService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $user = auth()->user();
            $psychologist = $this->getPsychologistByUserIdService->execute($user->id);
            $specialties = $request->input('specialties');
            $this->createPsychologistSpecialtyService->execute($psychologist->id, $specialties);

            DB::commit();
            return response()->json(['status' => true, 'message' => 'Especialidades cadastradas com sucesso.'], 200);
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['error' => true, 'status' => false, 'message' => $e->getMessage()], $e->getCode());
        }
    }
}
