<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExameTest extends Model
{
  protected $table = 'exame_tests';

  protected $fillable = array
  (     
    'exame_id',
    'cfc_id',
    'sexo',
    'escolaridade',
    'faixa_etaria',
    'concentrada',
    'dividida',
    'alternada',
    'memoria',
    'personalidade',
    'raciocinio' 
  );

    public function exame()
    {
        return $this->belongsTo(Exame::class);
    }
    public function cfc()
    {
        return $this->belongsTo(Cfc::class,'cfc_id');
    }
    public function vendas(){
        return $this->belongsTo(Venda::class,'venda_id');
    }
}
