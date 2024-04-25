<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';

    protected $fillable = array
    (
        'name',
        'cfc_id'
    );

    public function receitas()
    {
        return $this->hasMany(Receitas::class, 'categoria_id');
    }

    public function cfc()
    {
        return $this->belongsTo(Cfc::class, 'cfc_id');
    }
}
