<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContaRequest extends FormRequest
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
            'nome'=>'required|unique:contas_digitais|min:3|max:50',
            'data_abertura' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'nome' => 'Nome',
            'data_abertura' => 'Data de Abertura',
        ];
    }
}
