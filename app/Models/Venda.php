<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
   protected $table = 'vendas';

   protected $fillable = array
   (
    'aluno_id',
    'user_id',
    'cfc_id',
    'pacote_id',
    'nome',
    'valor_venda',
    'valor_pago',
    'desconto',
    'status',
    'data_venda',
    'forma_pagamento'
   );

   public function aluno()
   {
       return $this->belongsTo(Aluno::class,'aluno_id');
   }
   public function exames()
   {
        return $this->hasMany(Exame::class,'venda_id');
   }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function boleto()
    {
        return $this->hasMany(Boleto::class,'venda_id');
    }
    public function cfc(){
        return $this->belongsTo(Cfc::class,'cfc_id');
    }
    public function parcelas(){
        return $this->hasMany(Parcela::class,'venda_id');
    }
    public function vendaServico(){
        return $this->hasMany(Venda_servico::class,'venda_id');
    }

    public function pacote(){
        return $this->belongsTo(Pacote::class,'pacote_id');
    }
}
