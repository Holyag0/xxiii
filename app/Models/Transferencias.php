<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transferencias extends Model
{
    protected $table = 'transferencias';

    protected $fillable = array
        (
            'data_transferencia',
            'conta_origem',
            'conta_destino',
            'valor',
            'obs',
        );

    public function contaOrigem()
    {
        return $this->belongsTo(ContasDigitais::class, 'conta_origem');
    }

    public function contaDestino()
    {
        return $this->belongsTo(ContasDigitais::class, 'conta_destino');
    }

}
