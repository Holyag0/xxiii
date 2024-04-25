<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClinicasUpdateRequest extends FormRequest
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
    public function rules(DefaultRequest $request)
    {
        return [
            'nome'=>[
                'required',
                'min:3',
                'max:50',
                Rule::unique('clinicas')->ignore($request->segment(3)),
            ],
        ];
    }

    public function attributes()
    {
        return [
            'nome' => 'Nome',
            'clinica_id' => 'Clínica',
            'data_abertura' => 'Data de Abertura',
            'status' => 'Status',
        ];
    }
}
