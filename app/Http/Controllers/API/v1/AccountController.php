<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\UpdatePsychologistRequest;
use App\Services\API\v1\City\GetCityByIdService;
use App\Services\API\v1\Language\GetAllLanguagesService;
use App\Services\API\v1\City\GetCitiesByStateService;
use App\Services\API\v1\Psychologist\CancelAccountPsychologistService;
use App\Services\API\v1\Psychologist\CreatePsychologistLanguageService;
use App\Services\API\v1\Psychologist\GetPsychologistByUserIdService;
use App\Services\API\v1\Psychologist\UpdatePsychologistBankService;
use App\Services\API\v1\Psychologist\UpdatePsychologistService;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    private $getPsychologistByUserIdService;
    private $getCitiesByStateService;
    private $updatePsychologistService;
    private $getAllLanguagesService;
    private $createPsychologistLanguageService;
    private $get_city_by_id_service;
    private $update_psychologist_bank_service;
    private $cancel_account_psychologist_service;

    public function __construct(GetPsychologistByUserIdService $getPsychologistByUserIdService,
        GetCitiesByStateService $getCitiesByStateService,
        UpdatePsychologistService $updatePsychologistService,
        GetAllLanguagesService $getAllLanguagesService,
        CreatePsychologistLanguageService $createPsychologistLanguageService,
        GetCityByIdService $get_city_by_id_service,
        UpdatePsychologistBankService $update_psychologist_bank_service,
        CancelAccountPsychologistService $cancel_account_psychologist_service)
    {
        $this->getPsychologistByUserIdService = $getPsychologistByUserIdService;
        $this->getCitiesByStateService = $getCitiesByStateService;
        $this->updatePsychologistService = $updatePsychologistService;
        $this->getAllLanguagesService = $getAllLanguagesService;
        $this->createPsychologistLanguageService = $createPsychologistLanguageService;
        $this->get_city_by_id_service = $get_city_by_id_service;
        $this->update_psychologist_bank_service = $update_psychologist_bank_service;
        $this->cancel_account_psychologist_service = $cancel_account_psychologist_service;
    }

    public function index()
    {
        try{
            $user = auth()->user();
            $psychologist = $user->psychologist;
            $psychologist_languages = $psychologist->languages;
            $cities = $this->getCitiesByStateService->execute($psychologist->state);
            $languages = $this->getAllLanguagesService->execute();

            return response()->json([
                'status' => true,
                'message' => 'Successfully',
                'psychologist' => $psychologist,
                'psychologist_bank' => $psychologist->bank,
                'psychologist_languages' => $psychologist_languages,
                'cities' => $cities,
                'languages' => $languages,
            ], 200);
        }catch(\Exception $e){
            return response()->json(['error' => true, 'status' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function store(UpdatePsychologistRequest $request)
    {
        try{
            $data = [];
            $user = auth()->user();
            $psychologist = $user->psychologist;


            if($request->input('action') === 'infopersonal') {
                $data = $request->input('infoPersonal');
                $city = $this->get_city_by_id_service->execute($data['city_id']);

                $data['birth'] = dateEN($data['birth']);
                $data['cpf'] = onlyNumber($data['cpf']);
                $data['phone'] = onlyNumber($data['phone']);
                $data['state'] = $city->state;
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
                $this->update_psychologist_bank_service->execute($data);
            }

            $this->updatePsychologistService->execute($psychologist->id, $data);


            return response()->json(['status' => true, 'message' => 'Dados cadastrados com sucesso.', 'request' => $data], 200);
        }catch(\Exception $e){
            return response()->json(['error' => true, 'status' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy(Request $request)
    {
      try{
        $psychologist = auth()->user()->psychologist;

        $this->cancel_account_psychologist_service->execute($psychologist);

        return response()->json(['status' => true, 'messagem' => 'succes'], 200);
      }catch(\Exception $ex){
        return response()->json(['status' => false, 'messagem' => $ex->getMessage()], 500);
      }
    }
}
