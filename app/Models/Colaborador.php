<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{

    protected $table = 'colaboradores';
    
        protected $fillable = array
        (
            'cfc_id',
            'nome',
            'cpf',
            'funcoes'
        );

    public function cfc()
    {
        return $this->belongsTo(Cfc::class,'cfc_id');
    }
    
    public function atendimentos()
    {
        return $this->hasMany(Atendimento::class);
    }
}
