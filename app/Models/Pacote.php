<?php

namespace App\Models;

use App\Presenters\PacotePresenter;
use Illuminate\Database\Eloquent\Model;

class Pacote extends Model
{
    use PacotePresenter;
    
    protected $table = 'pacotes';
    
        protected $fillable = array
        (
            'cfc_id',
            'processo_id',
            'nome',
            'categoria',
            'desconto_boleto',
            'valor_credito',
            'status',
        );

    public function cfc()
    {
        return $this->belongsTo(Cfc::class,'cfc_id');
    }

    public function servicos()
    {
        return $this->belongsToMany(Servicos::class,'pacotes_servicos', 'pacote_id','servico_id')
        ->withTimestamps();
    }

    public function alunos()
    {
        return $this->hasMany(Aluno::class);
    }

    public function vendas()
    {
        return $this->hasMany(Venda::class);
    }

    public function financeiro()
    {
        return $this->hasMany(FinanceiroAluno::class);
    }
    public function processos(){
        return $this->belongsTo(Processo::class,'processo_id');
    }
   
}
