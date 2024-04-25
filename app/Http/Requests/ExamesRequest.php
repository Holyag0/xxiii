<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamesRequest extends FormRequest
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
        $data = $request->all();
        $profissional_id = '';
        $data_exame = '';
        $turno_exame = '';

        if($data['status'] != 'A Fazer')
        {
            $profissional_id = "required";
            $data_exame = "required";
            $turno_exame = "required";
        }

        return [
            'status' => 'required',
            'profissional_id' => $profissional_id,
            'data_exame' => $data_exame,
            'turno' => $turno_exame,
        ];
    }

    public function attributes()
    {
        return [
            'status' => 'Status',
            'profissional_id' => 'Profissional Responsável',
            'data_exame' => 'Data do Exame',
            'turno' => 'Turno',
        ];
    }

   
}