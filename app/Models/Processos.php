<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Processos extends Model
{
    protected $table = 'processos';

    protected $fillable = array
    (   
        'user_id',
        'cfc_id',
        'aluno_id',
        'categoria',
        'servicos',
        'validade_processo',
        'status',
        'taxas',
    );

    public function user()
    {
        return $this->hasOne(User::class,'user_id');
    }

    public function cfc()
    {
        return $this->belongsTo(Cfc::class,'cfc_id');
    }
    public function alunos()
    {
        return $this->belongsTo(Aluno::class);
    }
    public function pacotes()
    {
        return $this->hasMany(Pacote::class);
    }
}

