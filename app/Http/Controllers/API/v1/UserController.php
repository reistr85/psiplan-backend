<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\StoreUserRequest;
use App\Services\API\v1\User\StoreUserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{

    private $userService;
    private $storeUserService;

    public function __construct(StoreUserService $storeUserService)
    {
        $this->storeUserService = $storeUserService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return Response
     */
    public function store(StoreUserRequest $request)
    {
        try{

            $user_type_id = null;
            $data = $request->only('type', 'user.name', 'user.email', 'user.phone', 'user.password');

            switch($data['type']){
                case 'admin': $data['user']['type_user_id'] = 1; break;
                case 'psi': $data['user']['type_user_id'] = 2; break;
                case 'cli': $data['user']['type_user_id'] = 3; break;
                case 'emp': $data['user']['type_user_id'] = 4; break;
            }

            $data['user']['password'] = bcrypt($data['user']['password']);
            $this->storeUserService->execute($user_type_id, $data['user']);

            return response()->json(['status' => true, 'message' => 'Successfully'], 200);
        }catch(\Exception $e){
            return response()->json(['error' => true, 'status' => false, 'message' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function forgotPassword(Request $request)
    {
//        try{
//
//            $data = $request->only('data');
//            $return = $this->userService->forgotPassword($data['data']);
//
//            if(!$return)
//                return response()->json(['message' => 'E-mail e/ou CPF não localizado.'], 202);
//
//            return response()->json(['message' => 'Foi enviado um e-mail com instruções para você alterar sua senha.'], 200);
//        }catch(\Exception $e){
//            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
//        }
    }
}
