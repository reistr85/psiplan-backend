<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\StoreUserRequest;
use App\Http\Requests\API\v1\UpdateUserPasswordRequest;
use App\Mail\NewClient;
use App\Mail\NewPsychologist;
use App\Services\API\v1\Client\CreateClientService;
use App\Services\API\v1\Psychologist\CreatePsychologist;
use App\Services\API\v1\Psychologist\CreatePsychologistPreferencesService;
use App\Services\API\v1\User\StoreUserService;
use App\Services\API\v1\User\UpdateUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    private $storeUserService;
    private $updateUserService;
    private $createPsychologist;
    private $createClientService;
    private $create_psychologist_preferences_service;

    public function __construct(
        StoreUserService $storeUserService,
        CreatePsychologist $createPsychologist,
        UpdateUserService $updateUserService,
        CreateClientService $createClientService,
        CreatePsychologistPreferencesService $create_psychologist_preferences_service)
    {
        $this->storeUserService = $storeUserService;
        $this->createPsychologist = $createPsychologist;
        $this->updateUserService = $updateUserService;
        $this->createClientService = $createClientService;
        $this->create_psychologist_preferences_service = $create_psychologist_preferences_service;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return JsonResponse
     */
    public function store(StoreUserRequest $request)
    {
        DB::beginTransaction();
        try{
            $user_type_id = null;
            $data = $request->only('type', 'name', 'email', 'phone', 'password');

            $user['name'] = $data['name'];
            $user['email'] = $data['email'];
            $user['password'] = bcrypt($data['password']);

            switch($data['type']){
                case 'admin': $user['type_user_id'] = 1; break;
                case 'psi': $user['type_user_id'] = 2; break;
                case 'cli': $user['type_user_id'] = 3; break;
                case 'emp': $user['type_user_id'] = 4; break;
            }

            $user = $this->storeUserService->execute($user);

            if($user->type_user_id == 2) {
                $data_psychologist = [
                    'user_id' => $user->id,
                    'city_id' => 1,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => onlyNumber($request->input('phone')),
                    'country' => 'Brasil',
                ];

                $psychologist = $this->createPsychologist->execute($data_psychologist);
                $this->create_psychologist_preferences_service->execute($psychologist->id);

                Mail::send(new NewPsychologist($data_psychologist));
            }

            if($user->type_user_id == 3) {
                $data_client = [
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => onlyNumber($request->input('phone')),
                    'country' => 'Brasil',
                ];

                $this->createClientService->execute($data_client);
                Mail::send(new NewClient($data_client));
            }

            DB::commit();

            return response()->json(['status' => true, 'message' => 'Successfully'], 200);
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['error' => true, 'status' => false, 'message' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserPasswordRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateUserPasswordRequest $request, int $id): JsonResponse
    {
        try{
            $user = auth()->user();
            $data['password'] = bcrypt($request->input('new_password'));

            $this->updateUserService->execute($user, $data);

            return response()->json(['status' => true, 'message' => 'Sua senha foi alterada com sucesso.'], 200);
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['error' => true, 'status' => false, 'message' => $e->getMessage()], $e->getCode());
        }
    }
}
