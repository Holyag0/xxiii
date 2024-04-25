<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicosAlunos extends Model
{
    protected $table = 'servicos_alunos';

    protected $fillable = array
    (
        'servico_id',
        'aluno_id',
        'status'
    );
}
