<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $table = 'fornecedores';

    protected $fillable = array
    (
        'nome',
        'cfc_id',
        'cpfCnpj',
        'email',
        'telefone',
        'celular',
        'cep',
        'logradouro',
        'numero',
        'estado',
        'cidade',
        'bairro',
        'complemento',
        'obs'
    );
    public function cfc()
    {
        return $this->belongsTo(Cfc::class,'cfc_id');
    }

    public function despesas()
    {
        return $this->hasMany(Despesas::class, 'centro_custo_id');
    }
}
