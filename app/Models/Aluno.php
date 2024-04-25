<?php

namespace App\Models;

use App\Presenters\AlunoPresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Aluno extends Model
{
    use AlunoPresenter, Notifiable;

    protected $table = 'alunos';

        protected $fillable = array
        (
            'clinica_id',
            'cfc_id',
            'avulso_id',
            'processo_id',
            'nome',
            'pai',
            'mae',
            'email',
            'cpf',
            'rg',
            'cep',
            'logradouro',
            'numero',
            'complemento',
            'bairro',
            'cidade',
            'estado',
            'celular',
            'tipo',
            'status',
            'cnh',
            'date_nasc',
            'escolaridade',
            'estado_civil',

        );
        
        public function processos(){
            return $this->hasMany(Processos::class,);
        }
        public function clinica()
        {
            return $this->hasMany(Clinica::class,'clinica_id');
        }

        public function cfc()
        {
            return $this->belongsTo(Cfc::class,'cfc_id');
        }

        public function user()
        {
            return $this->belongsTo(User::class,'aluno_id');
        }

        public function atendimentos()
        {
            return $this->hasMany(Atendimento::class,'atendimento_id');
        }

        public function financeiro()
        {
            return $this->hasMany(FinanceiroAluno::class);
        }

        public function transacoes()
        {
            return $this->hasMany(Transacao::class);
        }

        public function historicos()
        {
            return $this->hasMany(HistoricoAluno::class,'aluno_id');
        }

        public function receitas()
        {
            return $this->hasMany(Receitas::class,'aluno_id');
        }
        public function vendas(){
            return $this->hasMany(Venda::class);
        }
}
