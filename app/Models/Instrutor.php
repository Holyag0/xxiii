<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instrutor extends Model
{
   protected $table = 'instrutores';

   protected $fillable = array
   (
     'cfc_id',
     'nome',
     'email',
     'cpf',
     'data_nascimento',
     'categoria',
     'venc_cnh',
     'venc_ci',
     'n_registro_cnh',
     'inicio_ferias',
     'fim_ferias',
     'portal',
     'cidade',
     'estado',
     'logradouro',
     'numero',
     'complemento',
     'bairro',
     'cep',
     'cel', 
     'valor_hora_extra',
     'valor_aula_extra',
     'valor_produtividade',
     'saida_almoco',
     'retorno_almoco',
     'status',

   );

   public function exames()
   {
    return $this->hasMany(Exame::class, 'instrutor_id');
   }

  public function users(){
    return $this->belongsTo(User::class,'instrutor_id');
  }
}
