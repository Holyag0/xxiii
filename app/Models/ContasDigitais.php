<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContasDigitais extends Model
{
    protected $table = 'contas_digitais';

    protected $fillable = array
        (
            'cfc_id',
            'nome',
            'saldo_inicial',
            'saldo_atual',
            'data_abertura',
            'status'
        );

    public function cfc()
    {
        return $this->belongsTo(Cfc::class, 'cfc_id');
    }

    public function transacoes(){
        return $this->hasMany(Transacao::class, 'conta_id');
    }
}
