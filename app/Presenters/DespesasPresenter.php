<?php

namespace App\Presenters;
use Carbon\Carbon;

trait DespesasPresenter
{
   public function getStatusPagoAttribute()
   {
        if($this->status == 1)
        {
            return "style='background-color: #01ff703b'";
        }else{
            return '';
        }
   }

   public function getStatusLabelAttribute()
   {
        if($this->status == 0)
        {
            return "A pagar";
        }else{
            return 'Paga';
        }
   }

   public function getBotoesAttribute()
   {
        if($this->status == 0)
        {
            return "A pagar";
        }else{
            return 'Paga';
        }
   }
}
