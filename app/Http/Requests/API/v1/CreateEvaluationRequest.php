<?php

namespace App\Http\Requests\API\v1;


class CreateEvaluationRequest extends APIFormRequest
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
            'star' => 'required',
            'psychologist_id' => 'required',
            'comment' => 'required|min:10',
        ];
    }
}
