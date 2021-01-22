<?php


namespace App\Services\API\v1\Pagarme;


use GuzzleHttp\Client;

class GetAllPagarmePlansService
{
    public function execute()
    {
        $client_guzlle = new Client();
        $url_base = env('URL_BASE_PAGARME');

        $data['api_key'] = env('API_KEY_PAGARME');
        $data['page'] = '1';

        $response = $client_guzlle->get("{$url_base}/plans", [
            'headers' => [
                'Accept'     => 'application/json',
            ],
            'json' => $data,
        ]);

        if($response->getStatusCode() != 200)
            throw new \Exception("Ocorre um erro no pagamento!", $response->getStatusCode());

        $all_plans = json_decode($response->getBody()->getContents());

        $plans_active = [];
        $plans_active_id = explode('@', env('PLANS_ACTIVE'));

        foreach($all_plans as $item){
            if(in_array($item->id, $plans_active_id)) {
                array_push($plans_active, $item);
            }
        }

        return $plans_active;
    }
}
