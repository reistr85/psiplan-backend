<?php


namespace App\Services\API\v1\PaymentPlanPsychologist;


use GuzzleHttp\Client;

class ReverseSubscriptionPsychologistService
{
    public function execute(int $subscription_id)
    {
        $client_guzlle = new Client();
        $url_base = env('URL_BASE_PAGARME');

        $response = $client_guzlle->post("{$url_base}/subscriptions/{$subscription_id}/cancel", [
            'headers' => [
                'Accept'     => 'application/json',
            ],
            'json' => [
                'api_key' => env('API_KEY_PAGARME')
            ],
        ]);
    }
}
