<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Services\API\v1\User\GetAllUsersNotificationsService;
use App\Services\API\v1\User\UpdateStatusUserNotificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserNotificationController extends Controller
{

    private $get_all_users_notifications_service;
    private $update_status_user_notification_service;

    public function __construct(
        GetAllUsersNotificationsService $get_all_users_notifications_service,
        UpdateStatusUserNotificationService $update_status_user_notification_service)
    {
        $this->get_all_users_notifications_service = $get_all_users_notifications_service;
        $this->update_status_user_notification_service = $update_status_user_notification_service;
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
            $user_notifications = $this->get_all_users_notifications_service->execute($user);

            return response()->json(['status' => true, 'message' => 'success', 'user_notifications' => $user_notifications], 200);
        }catch (\Exception $ex){
            return response()->json(['status' => false, 'message' => $ex->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
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
     * @param Request $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        try{
            $data = $request->all();
            $this->update_status_user_notification_service->execute($id, $data);

            return response()->json(['status' => true, 'message' => 'success'], 200);
        }catch (\Exception $ex){
            return response()->json(['status' => false, 'message' => $ex->getMessage()], 500);
        }
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
