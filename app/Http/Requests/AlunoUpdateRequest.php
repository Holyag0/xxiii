<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlunoUpdateRequest extends FormRequest
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
        $id = $this->segment(3);
        $cnh = "";

        if(auth()->user()->hasRole('Avulso'))
            $cnh = "required";


        return [
            'nome'=>'required|min:3|max:50',
            'cpf' => "required|cpf|min:11|max:11|unique:alunos,cpf,{$id},id",
            'email' => 'required',
            'clinica_id' => 'required',
            'cfc_id' => 'cfc_id',
            'logradouro' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'estado' => 'required',
            'celular' => 'required',
            'cnh' => $cnh
        ];
    }

    public function attributes()
    {
        return [
            'nome' => 'Nome',
            'auto_escola_id' => 'Auto Escola',
            'clinica_id' => 'Clínica',
            'cfc_id' => 'Auto Escola',
            'data_exame' => 'Data do Exame',
            'email' => 'Email',
            'cep' => 'CEP',
            'logradouro' => 'Logradouro',
            'numero' => 'Número',
            'bairro' => 'Bairro',
            'cidade' => 'Cidade',
            'estado' => 'Estado',
            'celular' => 'Celular',
        ];
    }

    public function validationData()
    {
        $data = $this->all();

        $data['cpf'] = preg_replace('/[^0-9]/', '', $data['cpf']);

        return $data;
    }
}
