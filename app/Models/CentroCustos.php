<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CentroCustos extends Model
{
    protected $table = 'centro_custos';

    protected $fillable = array
    (
        'name',
        'cfc_id'
    );

    public function despesas()
    {
        return $this->hasMany(Despesas::class, 'centro_custo_id');
    }

    public function cfc()
    {
        return $this->belongsTo(Cfc::class, 'cfc_id');
    }
}
