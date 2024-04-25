<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CfcRequest extends FormRequest
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
            'cnpj'=>'required|unique:auto_escola|min:12|max:12',
            'nome'=>'required|min:3|max:120',
        ];
    }
    
    public function attributes()
    {
        return [
            'nome' => 'Nome',
            'cnpj' => 'CNPJ',
        ];
    }
}
