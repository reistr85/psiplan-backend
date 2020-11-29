<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\StoreUserRequest;
use App\Http\Requests\API\v1\UpdateUserPasswordRequest;
use App\Services\API\v1\Psychologist\CreatePsychologist;
use App\Services\API\v1\User\StoreUserService;
use App\Services\API\v1\User\UpdateUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    private $storeUserService;
    private $updateUserService;
    private $createPsychologist;

    public function __construct(StoreUserService $storeUserService, CreatePsychologist $createPsychologist, UpdateUserService $updateUserService)
    {
        $this->storeUserService = $storeUserService;
        $this->createPsychologist = $createPsychologist;
        $this->updateUserService = $updateUserService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return Response
     */
    public function store(StoreUserRequest $request)
    {
        DB::beginTransaction();
        try{
            $user_type_id = null;
            $data_psychologist = [];
            $client = [];
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
                    'avatar' => 'avatar.jpg',
                ];

                $psychologist = $this->createPsychologist->execute($data_psychologist);
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
