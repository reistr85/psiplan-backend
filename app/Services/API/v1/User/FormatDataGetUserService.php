<?php


namespace App\Services\API\v1\User;

use App\Enums\TypeServiceEnum;

class FormatDataGetUserService
{
    public function execute()
    {
        $user = auth()->user();

        $userData['id'] = encode($user->id);
        $userData['type_user_id'] = encode($user->type_user_id);
        $userData['name'] = $user->name;
        $userData['email'] = $user->email;

        if($user->type_user_id === TypeServiceEnum::TYPE_USER_ID_PSYCHOLOGIST) {
            $psychologist = $user->psychologist;
            $userData['psychologist_id'] = encode($psychologist->id);

            if($psychologist->plan_id){
                $userData['plan_id'] = encode($psychologist->plan->id);
                $userData['plan_name'] = $psychologist->plan->name;
            }
        }

        if($user->type_user_id === TypeServiceEnum::TYPE_USER_ID_CLIENT) {
            $client = $user->client;
            $userData['client_id'] = encode($client->id);
        }

        return $userData;
    }

}
