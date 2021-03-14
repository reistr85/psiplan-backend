<?php


namespace App\Services\API\v1\Pagarme;


use App\Models\PagarmePostBack;
use App\Repositories\PagarmePostBackRepository;

class StorePagarmePostBackService
{
    private $pagarme_post_back_repository;

    public function __construct(
        PagarmePostBackRepository $pagarme_post_back_repository)
    {
        $this->pagarme_post_back_repository = $pagarme_post_back_repository;
    }

    public function execute($payload)
    {
        if(!$payload)
            throw new \Exception("Payload empty", 500);

        $payload = str_replace('%5B', '[', $payload);
        $payload = str_replace('%5D', ']', $payload);
        $payload = str_replace('%20', ' ', $payload);
        $payload = str_replace('%3A', ':', $payload);
        $payload = str_replace('%2F', '/', $payload);
        $payload = str_replace('%40', '@', $payload);
        $payload = str_replace('%2B', '+', $payload);
        $arr_payload = explode('&', decodeASCII($payload));

        $model_namespace = '';
        $model_id = '';
        $postback_id = '';
        $postback_event = '';
        $postback_object = '';
        $postback_old_status = '';
        $postback_current_status = '';

        foreach($arr_payload as $value){
            $arr = explode('=', $value);
            $index = $arr[0];
            $value = $arr[1];

            if($index == 'id'){
                $postback_id = $value;
            }

            if($index == 'event'){
                $postback_event = $value;
            }

            if($index == 'object'){
                $postback_object = $value;
            }

            if($index == 'old_status'){
                $postback_old_status = $value;
            }

            if($index == 'current_status'){
                $postback_current_status = $value;
            }

            if($index == 'transaction[metadata][model]'){
                if($value == 'Query'){
                    $model_namespace = 'App\\Models\\Query';
                }
            }

            if($index == 'transaction[metadata][model_id]'){
                $model_id = $value;
            }
        }

        $data = [
            'pagarme_post_back_type' => $model_namespace,
            'pagarme_post_back_id' => $model_id,
            'postback_id' => $postback_id,
            'postback_event' => $postback_event,
            'postback_object' => $postback_object,
            'postback_old_status' => $postback_old_status,
            'postback_current_status' => $postback_current_status,
            'postback_payload' => $payload
        ];

        return $this->pagarme_post_back_repository->store($data);
    }
}
