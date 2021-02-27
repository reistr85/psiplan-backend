<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Services\API\v1\Psychologist\GetAllPaymentsPsychologistService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ManagementPaymentController extends Controller
{
    private $get_all_payments_psychologist_service;

    public function __construct(
        GetAllPaymentsPsychologistService $get_all_payments_psychologist_service)
    {
        $this->get_all_payments_psychologist_service = $get_all_payments_psychologist_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try{
            $user = auth()->user();
            $payments = $this->get_all_payments_psychologist_service->execute($user->id);

            return response()->json(['status' => true, 'message' => 'success', 'payments' => $payments], 200);
        }catch (\Exception $ex){
            return response()->json(['status' => false, 'message' => $ex->getMessage()], $ex->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
}
