<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cfc extends Model
{

    protected $table = 'cfcs';

        protected $fillable = array
        (
            'nome',
            'cnpj',
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

        public function users()
        {
            return $this->belongsToMany(User::class,'users_cfcs', 'cfc_id','user_id');
        }

        public function atendimentos()
        {
            return $this->hasMany(Atendimento::class,'cfc_id');
        }

        public function contasDigitais()
        {
            return $this->hasMany(ContasDigitais::class,'cfc_id');
        }

        public function categorias()
        {
            return $this->hasMany(Categoria::class,'cfc_id');
        }

        public function centroCustos()
        {
            return $this->hasMany(CentroCustos::class,'cfc_id');
        }

        public function colaboradores()
        {
            return $this->hasMany(Colaborador::class,'cfc_id');
        }

        public function pacotes()
        {
            return $this->hasMany(Pacote::class,'cfc_id');
        }

        public function servicos()
        {
            return $this->hasMany(Servicos::class,'cfc_id');
        }

        public function alunos()
        {
            return $this->hasMany(Aluno::class,'cfc_id');
        }

        public function boletos()
        {
            return $this->hasMany(Boleto::class,'cfc_id');
        }
        public function fornecedores()
        {
            return $this->hasMany(Fornecedor::class,'cfc_id');
        }
        public function receitas()
        {
            return $this->hasMany(Receitas::class,'cfc_id');
        }
        public function despesas()
        {
            return $this->hasMany(Despesas::class, 'cfc_id');
        }
        public function vendas(){

            return $this->hasMany(Venda::class,'cfc_id');
        }

        public function exameTest()
        {
          return $this->hasMany(ExameTest::class,'cfc_id');
        }   

        public function parcelaVenda(){
            return $this->hasMany(Parcela::class,'cfc_id');
        }
}