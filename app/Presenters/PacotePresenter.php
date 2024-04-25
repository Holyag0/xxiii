<?php

namespace App\Presenters;

trait PacotePresenter
{
   public function getServicoAttribute()
   {
       if(isset($this->servicos)){
            foreach($this->servicos as $servico){
                 echo $servico->nome.'<br>';
            }
       }
   }

   public function getValorAttribute()
   {
     $valor = 0;
       
     foreach($this->servicos as $servico) 
     {
         $valor += moneyToFloat($servico->valor);
     }

     return floatToMoney($valor);
   }
}