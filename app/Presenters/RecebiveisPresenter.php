<?php

namespace App\Presenters;

trait RecebiveisPresenter
{    

    public function getOpcoesAttribute()
    {
        switch ($this->status) {
            case 'pending':
                echo 
                "
                <a class='btn btn-danger btn-sm float-sm-right' href='#' data-toggle='modal' data-target='.show{$this->id}'>
                    Cancelar Boleto
                </a>
                "."<a href='$this->boleto' target='_blank' class='btn btn-sm btn-dark float-sm-right'><i class='fas fa-barcode'></i> 2ª Via Boleto</a>";
                break;
        }
    }

    public function getValorLabelAttribute()
    {
        if(isset($this->valor)){
            $valor = moneyToFloat($this->valor);

            return floatToMoney($valor);
        }else{
            return "Nenhum valor à receber!";
        }
    }


}