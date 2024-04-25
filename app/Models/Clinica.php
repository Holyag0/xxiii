<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clinica extends Model
{
    protected $table = 'clinicas';

        protected $fillable = array
        (
            'cnpj',
            'cfc_id',
            'nome',
            'endereco',
            'numero',
            'complemento',
            'bairro',
            'cep',
            'cidade',
            'estado',
            'celular',
            'fone',
            'email',
        );

        public function alunos()
        {
            return $this->hasMany(Aluno::class,'clinicas');
        }

}
