<?php

namespace App\Http\Requests\API\v1;

class CreatePsychologistDocumentRequest extends APIFormRequest
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
            'crp' => 'required|file|mimes:pdf',
            'address' => 'required|file|mimes:pdf',
            'certificate_crp' => 'required|file|mimes:pdf',
            'epsi' => 'required|file|mimes:pdf',
        ];
    }
}
