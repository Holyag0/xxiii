<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda_servico extends Model
{
    protected $table = 'venda_servicos';

    protected $fillable = array
    (  
        'venda_id',
        'cfc_id',
        'nome',
        'valor',
        'desconto',
        'status',
        'quantidade'
    );
    public function venda(){
        return $this->belongsTo(Venda::class,'venda_id');
    }
}
