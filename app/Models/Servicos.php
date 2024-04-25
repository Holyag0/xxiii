<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicos extends Model
{
    protected $table = 'servicos';

    protected $fillable = array
    (
        'nome',
        'valor',
        'categoria',
        'cfc_id'
    );

    public function pacotes()
    {
        return $this->belongsToMany(Pacote::class,'pacotes_servicos', 'servico_id','pacote_id')->withTimestamps();
    }

    public function cfc()
    {
        return $this->belongsTo(Cfc::class,'cfc_id');
    }
}
