<?php


namespace App\Services\API\v1\User;


class FormatDataGetUserService
{
    public function execute()
    {
        $user = auth()->user();

        $userData['id'] = encode($user->id);
        $userData['type_user_id'] = encode($user->type_user_id);
        $userData['name'] = $user->name;
        $userData['email'] = $user->email;

        if($user->type_user_id === 2) {
            $psychologist = $user->psychologist;
            $userData['plan_id'] = encode($psychologist->plan->id);
            $userData['plan_name'] = $psychologist->plan->name;
            $userData['psychologist_id'] = encode($psychologist->id);
        }

        if($user->type_user_id === 3) {
            $client = $user->client;
            $userData['client_id'] = encode($client->id);
        }

        return $userData;
    }

}
