<?php

namespace App\Models;

use App\Presenters\ReceitasPresenter;
use Illuminate\Database\Eloquent\Model;

class Receitas extends Model
{
    use ReceitasPresenter;

    protected $table = 'receitas';

    protected $fillable = array
        (
            'cfc_id',
            'categoria_id',
            'transacao_id',
            'aluno_id',
            'parcela_id',
            'auto_escola_id',
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
        return $this->belongsTo(Cfc::class, 'cfc_id');
    }

    public function transacao()
    {
        return $this->belongsTo(Transacao::class, 'transacao_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function aluno()
    {
        return $this->belongsTo(Aluno::class, 'aluno_id');
    }

    public function parcela()
    {
        return $this->belongsTo(Parcela::class, 'parcela_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
