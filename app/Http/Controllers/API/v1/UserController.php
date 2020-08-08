<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\UserFormRequest;
use App\Services\API\v1\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFormRequest $request)
    {
        try{

            $data = $request->only('terms', 'name', 'email', 'cpf', 'password', 'type_user_id', 'active');
            $user = $this->userService->userStore($data);

            return response()->json($user, 201);

        }catch(\Exception $e){
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function forgotPassword(Request $request)
    {
        try{

            $data = $request->only('data');
            $return = $this->userService->forgotPassword($data['data']);

            if(!$return)
                return response()->json(['message' => 'E-mail e/ou CPF não localizado.'], 202);

            return response()->json(['message' => 'Foi enviado um e-mail com instruções para você alterar sua senha.'], 200);
        }catch(\Exception $e){
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }
}
