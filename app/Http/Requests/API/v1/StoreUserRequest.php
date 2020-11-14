<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreUserRequest extends APIFormRequest
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
            'type' => 'required',
            'terms' => function($att, $value, $fail){
                if(is_null($value)){
                    return $fail("É necessário aceitar os termos de uso da plataforma.");
                }
            },
            'name' => 'required|min:3|max:150',
            'email' => 'required|unique:users,email,'.$this->id.',id,deleted_at,NULL',
            'phone' => 'required|min:11',
            'password' => 'required|min:6',

        ];
    }
}
