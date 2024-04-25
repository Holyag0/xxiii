<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransferenciaRequest extends FormRequest
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
            'conta_origem'=>'required',
            'conta_destino'=>'required',
            'data_transferencia' => 'required',
            'valor' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'data_transferencia' => 'Data',
            'valor' => 'Valor',
            'conta_origem' => 'Conta Origem',
            'conta_destino' => 'Conta Destino',
        ];
    }
}
