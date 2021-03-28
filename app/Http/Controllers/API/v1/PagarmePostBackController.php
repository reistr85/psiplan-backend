<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\PagarmePostBack;
use App\Services\API\v1\Pagarme\StorePagarmePostBackService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PagarmePostBackController extends Controller
{
    private $store_pagarme_post_back_service;

    public function __construct(
        StorePagarmePostBackService $store_pagarme_post_back_service)
    {
        $this->store_pagarme_post_back_service = $store_pagarme_post_back_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try{
            $post_backs = PagarmePostBack::all();


            return response()->json(['status' => true, 'post_backs' => $post_backs], 200);
        }catch (\Exception $ex){
            return response()->json(['status' => false, 'message' => $ex->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try{
            Log::error($request->all());

            $data = [
                'pagarme_post_back_type' => $request->transaction['metadata']['model'],
                'pagarme_post_back_id' => $request->transaction['metadata']['model_id'],
                'postback_id' => $request->id,
                'postback_event' => $request->event,
                'postback_object' => $request->object,
                'postback_old_status' => $request->old_status,
                'postback_current_status' => $request->current_status,
                'postback_payload' => $request->all(),
            ];

            $post_back = $this->store_pagarme_post_back_service->execute($data);
            echo 'success';
        }catch (\Exception $ex){
            return response()->json(['status' => false, 'message' => $ex->getMessage()], 500);
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
     * @param Request $request
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
