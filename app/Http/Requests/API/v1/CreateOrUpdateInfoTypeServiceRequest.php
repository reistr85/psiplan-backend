<?php

namespace App\Http\Requests\API\v1;

use App\Enums\TypeServiceEnum;
use Illuminate\Foundation\Http\FormRequest;

class CreateOrUpdateInfoTypeServiceRequest extends APIFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $verify_address = false;

        //verifica se o tipo de atendimento presencial foi selecionado.
        if(array_search(TypeServiceEnum::TYPE_SERVICE_PRESENTIAL, array_column($this->input('type_services'), 'type_service_id')) !== false)
            $verify_address = true;

        if($verify_address) {
            return [
                'address.zip_code' => 'required|digits:8',
                'address.state' => 'required|min:2|max:2',
                'address.city' => 'required',
                'address.neighborhood' => 'required',
                'address.street' => 'required',
                'address.maps' => function ($att, $value, $fail) {

                },
                'target_audiences' => 'required',
                'consultation_value' => function ($att, $value, $fail) {
                    if ($value < 70)
                        return $fail("O valor da consulta não pode ser menor que R$70,00");
                },
            ];
        }

        return [
            'type_services' => function ($att, $value, $fail){
                if (!count($this->input('type_services'))) {
                    return $fail("Você precisa escolher pelo menos um tipo de atendimento.");
                }
            },
            'target_audiences' => 'required',
            'consultation_value' => function ($att, $value, $fail) {
                if ($value <= 0) {
                    return $fail("O valor da consulta precisa ser maior que zero.");
                }
            },
        ];
    }
}
