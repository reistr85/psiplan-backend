<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\CreateOrUpdateInfoTypeServiceRequest;
use App\Http\Requests\API\v1\UpdateInfoExtrasPsychologistRequest;
use App\Services\API\v1\Psychologist\CreateOrUpdatePsychologistServiceAddressService;
use App\Services\API\v1\Psychologist\CreatePsychologistTargetAudienceService;
use App\Services\API\v1\Psychologist\CreatePsychologistTypeServiceService;
use App\Services\API\v1\Psychologist\GetInfoQueriesService;
use App\Services\API\v1\Psychologist\GetPsychologistServiceAddressService;
use App\Services\API\v1\Psychologist\GetPsychologistByUserIdService;
use App\Services\API\v1\Psychologist\GetPsychologistTargetAudienceService;
use App\Services\API\v1\Psychologist\UpdatePsychologistService;
use App\Services\API\v1\TargetAudience\GetAllTargetAudiencesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueryController extends Controller
{
    private $getPsychologistByUserIdService;
    private $getInfoQueriesService;
    private $getTargetAudiencesService;
    private $createPsychologistTypeServiceService;
    private $createPsychologistTargetAudienceService;
    private $updatePsychologistService;
    private $getPsychologistServiceAddressService;
    private $createOrUpdatePsychologistServiceAddressService;

    public function __construct(
        GetPsychologistByUserIdService $getPsychologistByUserIdService,
        GetInfoQueriesService $getInfoQueriesService,
        GetAllTargetAudiencesService $getTargetAudiencesService,
        CreatePsychologistTypeServiceService $createPsychologistTypeServiceService,
        CreatePsychologistTargetAudienceService $createPsychologistTargetAudienceService,
        UpdatePsychologistService $updatePsychologistService,
        GetPsychologistServiceAddressService $getPsychologistServiceAddressService,
        CreateOrUpdatePsychologistServiceAddressService $createOrUpdatePsychologistServiceAddressService)
    {
        $this->getInfoQueriesService = $getInfoQueriesService;
        $this->getPsychologistByUserIdService = $getPsychologistByUserIdService;
        $this->getTargetAudiencesService = $getTargetAudiencesService;
        $this->createPsychologistTypeServiceService = $createPsychologistTypeServiceService;
        $this->createPsychologistTargetAudienceService = $createPsychologistTargetAudienceService;
        $this->updatePsychologistService = $updatePsychologistService;
        $this->getPsychologistServiceAddressService = $getPsychologistServiceAddressService;
        $this->createOrUpdatePsychologistServiceAddressService = $createOrUpdatePsychologistServiceAddressService;
    }

    public function index(Request $request)
    {
        try{
            $user = auth()->user();
            $psychologist = $this->getPsychologistByUserIdService->execute($user->id);

            $target_audiences = $this->getTargetAudiencesService->execute();
            $psychologist_address_service = $this->getPsychologistServiceAddressService->execute($psychologist->id);

            return response()->json([
                'status' => true,
                'message' => 'Successfully',
                'psychologist' => $psychologist,
                'target_audiences' => $target_audiences,
            ], 200);
        }catch(\Exception $e){
            return response()->json(['error' => true, 'status' => false, 'message' => $e->getMessage()], $e->getCode());
        }
    }

    public function storeTypeService(CreateOrUpdateInfoTypeServiceRequest $request)
    {
        DB::beginTransaction();
        try{
            $user = auth()->user();
            $psychologist = $this->getPsychologistByUserIdService->execute($user->id);
            $data = $request->all();
            $dataUpdatePsychologist = ['consultation_value' => $data['consultation_value'], 'accessibility' => $data['accessibility']];
            $this->createPsychologistTypeServiceService->execute($psychologist->id, $data['type_services']);
            $this->createPsychologistTargetAudienceService->execute($psychologist->id, $data['target_audiences']);
            $this->createOrUpdatePsychologistServiceAddressService->execute($psychologist->id, $data['address'], $data['type_services']);
            $this->updatePsychologistService->execute($psychologist->id, $dataUpdatePsychologist);

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

    public function storeInfoExtras(UpdateInfoExtrasPsychologistRequest $request)
    {
        DB::beginTransaction();
        try{
            $user = auth()->user();
            $psychologist = $this->getPsychologistByUserIdService->execute($user->id);
            $data = $request->all();

            $this->updatePsychologistService->execute($psychologist->id, $data);

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
