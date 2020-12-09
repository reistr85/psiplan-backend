<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\CreateOrUpdateInfoTypeServiceRequest;
use App\Services\API\v1\Psychologist\CreatePsychologistTypeServiceService;
use App\Services\API\v1\Psychologist\GetInfoQueriesService;
use App\Services\API\v1\Psychologist\GetPsychologistByUserIdService;
use App\Services\API\v1\TargetAudience\GetAllTargetAudiencesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueryController extends Controller
{
    private $getPsychologistByUserIdService;
    private $getInfoQueriesService;
    private $getTargetAudiencesService;
    private $createPsychologistTypeServiceService;

    public function __construct(GetPsychologistByUserIdService $getPsychologistByUserIdService, GetInfoQueriesService $getInfoQueriesService,
                                GetAllTargetAudiencesService $getTargetAudiencesService, CreatePsychologistTypeServiceService $createPsychologistTypeServiceService)
    {
        $this->getInfoQueriesService = $getInfoQueriesService;
        $this->getPsychologistByUserIdService = $getPsychologistByUserIdService;
        $this->getTargetAudiencesService = $getTargetAudiencesService;
        $this->createPsychologistTypeServiceService = $createPsychologistTypeServiceService;
    }

    public function index(Request $request)
    {
        try{
            $user = auth()->user();
            $psychologist = $this->getPsychologistByUserIdService->execute($user->id);

            $target_audiences = $this->getTargetAudiencesService->execute();
            $this->getInfoQueriesService->execute($psychologist);

            return response()->json([
                'status' => true,
                'message' => 'Successfully',
                'target_audiences' => $target_audiences,
            ], 200);
        }catch(\Exception $e){
            return response()->json(['error' => true, 'status' => false, 'message' => $e->getMessage()], $e->getCode());
        }
    }

    public function store(CreateOrUpdateInfoTypeServiceRequest $request)
    {
        DB::beginTransaction();
        try{
            $user = auth()->user();
            $psychologist = $this->getPsychologistByUserIdService->execute($user->id);
            $type_services = $request->input('psychologist_type_services');

            $this->createPsychologistTypeServiceService->execute($psychologist->id, $type_services);

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'As informações foram salvas com sucesso.',
            ], 200);
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['error' => true, 'status' => false, 'message' => $e->getMessage()], $e->getCode());
        }
    }
}
