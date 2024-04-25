<?php

namespace App\Presenters;

trait BoletoPresenter
{
    public function getCpfAttribute()
    {
        if(isset($this->aluno->cpf)){
            return $this->aluno->cpf;
        }
    }

    public function getOpcoesAttribute()
    {
        if($this->status == "pending" && auth()->user()->hasRole(['Admin', 'Financeiro'])){
            echo
            "
            <a class='btn btn-danger btn-sm float-sm-right' href='#' data-toggle='modal' data-target='.cancelar{$this->id}'>
                Cancelar Boleto
            </a>
            ";
        }

        if($this->status == "pending"){
            echo "<a href='$this->boleto' target='_blank' class='btn btn-sm btn-dark float-sm-right'><i class='fas fa-barcode'></i> 2ª Via Boleto</a>";
        }

        if($this->status == "paid" || $this->status == "completed"){
            echo
            "
            <a class='btn btn-success btn-sm float-sm-right' href='#' data-toggle='modal' data-target='.detalhesBoleto{$this->id}'>
                Detalhes Boleto
            </a>
            ";
        }


    }

    public function getStatusBoletoAttribute()
    {
        switch ($this->status) {
            case 'pending':
                echo '<label class="badge badge-primary">Aguardando Pagamento</label>';
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
   }
}
