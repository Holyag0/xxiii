<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transacao extends Model
{
    protected $table = 'transacoes';

    protected $fillable = array
        (
            'conta_id',
            'cfc_id',
            'aluno_id',
            'user_id',
            'forma_pagamento',
            'valor',
            'tipo',
            'data_pagamento',
            'descricao',
            'favorecido',
        );

    public function conta()
    {
        return $this->belongsTo(ContasDigitais::class, 'conta_id');
    }

    public function receitas()
    {
        return $this->hasMany(Receitas::class, 'transacao_id');
    }

    public function despesas()
    {
        return $this->hasMany(Despesas::class, 'centro_custo_id');
    }

    public function aluno()
    {
        return $this->belongsTo(Aluno::class, 'aluno_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
