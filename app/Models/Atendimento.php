<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atendimento extends Model
{

    protected $table = 'atendimentos';
    
        protected $fillable = array
        (
            'cfc_id',
            'aluno_id',
            'colaborador_id',
            'servico',
        );

    public function cfc()
    {
        return $this->belongsTo(Cfc::class,'cfc_id');
    }

    public function aluno()
    {
        return $this->belongsTo(Aluno::class,'aluno_id');
    }

    public function colaborador()
    {
        return $this->belongsTo(Colaborador::class,'colaborador_id');
    }
}
