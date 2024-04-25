<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exame extends Model
{
    protected $table = 'exames';

        protected $fillable = array
        (   'cfc_id',
            'venda_id',
            'data_exame',
            'turno',
            'status',
            'tipo',
            'profissional_id',
        );
        
        public function cfc(){
            return $this->belongsTo(Cfc::class,'cfc_id');
        }
        public function venda(){
            return $this->belongsTo(Venda::class,'venda_id');
        }

        public function exameTeste(){
            return $this->hasOne(ExameTest::class);
        }

        
       
}
