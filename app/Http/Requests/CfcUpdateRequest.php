<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class CfcUpdateRequest extends FormRequest
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
            'cnpj'=> [
                'required',
                'min:18',
                'max:18',
                Rule::unique('cfcs')->ignore(Request::segment(3)),
            ],
            'nome'=>'required|min:3|max:120',
        ];
    }
    public function attributes()
    {
        return [
            'cnpj' => 'CNPJ',
            'nome' => 'Nome Fantasia',
        ];
    }
}
