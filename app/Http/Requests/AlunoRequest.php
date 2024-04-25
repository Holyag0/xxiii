<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class AlunoRequest extends FormRequest
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
        $id = $this->segment(3);
        $cnh = "";

        if(auth()->user()->hasRole('Avulso'))
            $cnh = "required";


        return [
            'nome'=>'required|min:3|max:50',
            'cpf' => "required|cpf|min:11|max:11|unique:alunos,cpf,{$id},id",
            'rg' => 'required',
            'estado_civil' => 'required',
            // 'cfc_id' => 'required',
            // 'clinica_id' => 'required',
            'email' => 'required',
            'logradouro' => 'required',
            'cep' => 'required',
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
            // 'cfc_id' => 'Auto Escola',
            // 'clinica_id' => 'Clínica',
            'data_exame' => 'Data do Exame',
            'email' => 'email',
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

        if(isset($data['cpf'])){
            $data['cpf'] = preg_replace('/[^0-9]/', '', $data['cpf']);

        return $data;
        }

        return $data;
        
    }
}
