<?php

namespace App\Models;

use App\Presenters\BoletoPresenter;
use Illuminate\Database\Eloquent\Model;

class Boleto extends Model
{
    use BoletoPresenter;

    protected $fillable = array
    (
        'cfc_id',
        'user_id',
        'venda_id',
        'due_date',
        'transaction_id',
        'value_cents',
        'paid_date',
        'status',
        'order_id',
        'boleto',
        'recebido',
    );

    public function cfc()
    {
        return $this->belongsTo(Cfc::class,'cfc_id');
    }

    public function venda()
    {
        return $this->belongsTo(Venda::class,'venda_id');
    }
}
