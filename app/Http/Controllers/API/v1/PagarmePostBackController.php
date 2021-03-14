<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\PagarmePostBack;
use App\Services\API\v1\Pagarme\StorePagarmePostBackService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
            $payload = $request->input('payload');
            $post_back = $this->store_pagarme_post_back_service->execute($payload);

            return response()->json(['status' => true, 'request' => $request->all(), 'post_back' => $post_back], 200);
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
