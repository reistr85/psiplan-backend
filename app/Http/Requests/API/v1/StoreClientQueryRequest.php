<?php

namespace App\Http\Requests\API\v1;

class StoreClientQueryRequest extends APIFormRequest
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
        return [
            'psychologist_id' => 'required',
            'day_hour' => 'required',
        ];
    }
}
