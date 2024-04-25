<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcela extends Model
{
    protected $table = 'parcelas';

    protected $fillable = array
    (  
        'venda_id',
        'cfc_id',
        'valor_parcela',
        'transacao_id',
        'desconto',
        'status',
        'data_pagamento',
        'forma_pagamento',
        'quantidade_parcelas'
    );

    public function venda(){
        return $this->belongsTo(Venda::class,'venda_id');
    }

    public function cfc(){
        return $this->belongsTo(Cfc::class,'cfc_id');
    }

    public function receitas(){
        return $this->hasMany(Receitas::class,'parcela_id');
    }
}
