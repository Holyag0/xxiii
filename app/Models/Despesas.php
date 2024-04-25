<?php

namespace App\Models;

use App\Presenters\ContasReceberPresenter;
use App\Presenters\DespesasPresenter;
use Illuminate\Database\Eloquent\Model;

class Despesas extends Model
{
    use DespesasPresenter;
    
    protected $table = 'despesas';

    protected $fillable = array
        (
            'cfc_id',
            'centro_custo_id',
            'transacao_id',
            'fornecedor_id',
            'user_id',
            'valor',
            'data_vencimento',
            'data_pagamento',
            'obs',
            'anexo',
            'status',
        );

    public function cfc()
    {
        return $this->belongsTo(Clinica::class, 'cfc_id');
    }

    public function transacao()
    {
        return $this->belongsTo(Transacao::class, 'transacao_id');
    }

    public function centroCusto()
    {
        return $this->belongsTo(CentroCustos::class, 'centro_custo_id');
    }

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class, 'fornecedor_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
