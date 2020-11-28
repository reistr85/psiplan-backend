<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\UpdatePsychologistRequest;
use App\Services\API\v1\City\GetAllCitiesService;
use App\Services\API\v1\City\GetCitiesByStateService;
use App\Services\API\v1\Psychologist\GetPsychologistByUserIdService;
use App\Services\API\v1\Psychologist\UpdatePsychologistService;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    private $getPsychologistByUserIdService;
    private $getByState;
    private $updatePsychologistService;

    public function __construct(GetPsychologistByUserIdService $getPsychologistByUserIdService, GetCitiesByStateService $getByState,
                                UpdatePsychologistService $updatePsychologistService)
    {
        $this->getPsychologistByUserIdService = $getPsychologistByUserIdService;
        $this->getByState = $getByState;
        $this->updatePsychologistService = $updatePsychologistService;
    }

    public function index()
    {
        try{
            $user = auth()->user();
            $psychologist = $this->getPsychologistByUserIdService->execute($user->id);
            $cities = $this->getByState->execute($psychologist->state);

            return response()->json(['status' => true, 'message' => 'Successfully', 'psychologist' => $psychologist, 'cities' => $cities], 200);
        }catch(\Exception $e){
            return response()->json(['error' => true, 'status' => false, 'message' => $e->getMessage()], $e->getCode());
        }
    }

    public function store(UpdatePsychologistRequest $request)
    {
        try{
            $user = auth()->user();
            $psychologist = $this->getPsychologistByUserIdService->execute($user->id);

            $data = $request->input('infoPersonal');
            $data['birth'] = dateEN($data['birth']);
            $data['cpf'] = onlyNumber($data['cpf']);
            $data['phone'] = onlyNumber($data['phone']);

            $this->updatePsychologistService->execute($psychologist, $data);


            return response()->json(['status' => true, 'message' => 'Dados cadastrados com sucesso.'], 200);
        }catch(\Exception $e){
            return response()->json(['error' => true, 'status' => false, 'message' => $e->getMessage()], $e->getCode());
        }
    }
}
