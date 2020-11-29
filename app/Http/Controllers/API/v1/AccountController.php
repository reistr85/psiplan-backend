<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\UpdatePsychologistRequest;
use App\Services\API\v1\Language\GetAllLanguagesService;
use App\Services\API\v1\City\GetAllCitiesService;
use App\Services\API\v1\City\GetCitiesByStateService;
use App\Services\API\v1\Psychologist\CreatePsychologistLanguageService;
use App\Services\API\v1\Psychologist\GetPsychologistByUserIdService;
use App\Services\API\v1\Psychologist\UpdatePsychologistService;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    private $getPsychologistByUserIdService;
    private $getCitiesByStateService;
    private $updatePsychologistService;
    private $getAllLanguagesService;
    private $createPsychologistLanguageService;

    public function __construct(GetPsychologistByUserIdService $getPsychologistByUserIdService, GetCitiesByStateService $getCitiesByStateService,
                                UpdatePsychologistService $updatePsychologistService, GetAllLanguagesService $getAllLanguagesService,
                                CreatePsychologistLanguageService $createPsychologistLanguageService)
    {
        $this->getPsychologistByUserIdService = $getPsychologistByUserIdService;
        $this->getCitiesByStateService = $getCitiesByStateService;
        $this->updatePsychologistService = $updatePsychologistService;
        $this->getAllLanguagesService = $getAllLanguagesService;
        $this->createPsychologistLanguageService = $createPsychologistLanguageService;
    }

    public function index()
    {
        try{
            $user = auth()->user();
            $psychologist = $this->getPsychologistByUserIdService->execute($user->id);
            $cities = $this->getCitiesByStateService->execute($psychologist->state);
            $languages = $this->getAllLanguagesService->execute();

            return response()->json([
                'status' => true,
                'message' => 'Successfully',
                'psychologist' => $psychologist,
                'cities' => $cities,
                'languages' => $languages,
            ], 200);
        }catch(\Exception $e){
            return response()->json(['error' => true, 'status' => false, 'message' => $e->getMessage()], $e->getCode());
        }
    }

    public function store(UpdatePsychologistRequest $request)
    {
        try{
            $data = [];
            $user = auth()->user();
            $psychologist = $this->getPsychologistByUserIdService->execute($user->id);

            if($request->input('action') === 'infopersonal') {
                $data = $request->input('infoPersonal');
                $data['birth'] = dateEN($data['birth']);
                $data['cpf'] = onlyNumber($data['cpf']);
                $data['phone'] = onlyNumber($data['phone']);
            }

            if($request->input('action') === 'infoadditional') {
                $data = $request->input('infoAdditional');
                $data['crp'] = onlyNumber($data['crp']);
                $data['pis'] = onlyNumber($data['pis']);

                $this->createPsychologistLanguageService->execute($psychologist->id, $data['psychologist_languages']);
            }

            if($request->input('action') === 'infobank') {
                $data = $request->input('infoBank');
                $data['cpf_holder_account'] = onlyNumber($data['cpf_holder_account']);
            }

            $this->updatePsychologistService->execute($psychologist, $data);


            return response()->json(['status' => true, 'message' => 'Dados cadastrados com sucesso.'], 200);
        }catch(\Exception $e){
            return response()->json(['error' => true, 'status' => false, 'message' => $e->getMessage()], $e->getCode());
        }
    }
}
