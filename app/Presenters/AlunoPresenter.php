<?php

namespace App\Presenters;
use Carbon\Carbon;

trait AlunoPresenter
{
   public function getTestAttribute()
   {
       if($this->status != "Aprovado")
       {
           return 1;
       }else{
           return 2;
       }
   }

   public function getStatusSituacaoAttribute()
   {
    // foreach($this->pacote->servicos as $servico)
    // {
    //     if($servico->pivot->status == NULL OR $servico->pivot->status == "Faltoso")
    //     {
    //         return true;
    //     }
    // }
   }

   public function getStatusInaptoAttribute()
   {
        if($this->status == "Inapto Temporariamente")
        {
            return 'd-none';
        }else{
            return '';
        }
   }

   public function getValorPagamentoAttribute()
   {
       $valor = 0;

       if(isset($this->pacote->servicos)){
            foreach($this->pacote->servicos as $servico)
            {
                $valor += moneyToFloat($servico->valor);
            }
       }

        return $valor;
   }

   public function getAgendamentoAttribute()
   {
        if($this->status == "Inapto Temporariamente"){
            foreach($this->servicos as $servico){
                if(isset($servico->pivot->data_remarcacao) && $servico->pivot->status == "Inapto Temporariamente"){
                        echo "Retorno para ".$servico->nome." no dia ".Carbon::parse($servico->pivot->data_remarcacao)->format('d/m/Y').'<br/>';
                }
            }
        }else{
            if(isset($this->exame) && $this->status != "Aprovado"){
                echo Carbon::parse($this->exame->data)->format('d/m/Y')." | ".$this->exame->turno;
            }
        }
   }

   public function getSituacaoExameAttribute()
   {
        foreach($this->servicos as $servico){
            echo $servico->nome." | ".$servico->pivot->status.'<br/>';
        }
   }

   public function getDataPagamentoAttribute()
   {
        if(isset($this->pagamento))
        {
            dd($this->pagamento);
        }
   }

   public function getStatusPagamentoAttribute()
   {
        switch ($this->boleto_status_pagamento) {
            case 'pending':
                echo '<label class="text-center badge badge-primary">Aguardando Pagamento</label>';
                break;
            case 'reserved':
                    echo '<label class="text-center badge badge-primary">Pago aguardando compensação</label>';
                    break;
            case 'canceled':
                echo '<label class="badge badge-danger">Boleto Cancelado</label>';
                break;
            case 'completed':
                echo '<label class="badge badge-success">Completo</label>';
                break;
            case 'paid':
                echo '<label class="badge badge-success">Pago</label>';
                break;
            case 'processing':
                echo '<label class="badge badge-warning">Boleto em análise</label>';
                break;
            case 'refunded':
                echo '<label class="badge badge-warning">Boleto Estornado</label>';
                break;
            case NULL:
                echo '<label class="badge badge-danger">Pagamento Pendente</label>';
                break;
        }

        return false;
   }
}
