<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Models\CreditoCFCPagos;

class ServiceCreditoCFCPagos
{
    private $creditosPagos;
    private $ServiceCfc;

    public function __construct(
        CreditoCFCPagos $creditosPagos,
        ServiceCfc $ServiceCfc
        )
    {
        $this->creditosPagos = $creditosPagos;   
        $this->ServiceCfc = $ServiceCfc;     
    }

    public function getCreditosPagos()
    {
        return $this->creditosPagos;
    }

    public function getServiceCfc()
    {
        return $this->ServiceCfc;
    }

    public function create($data)
    {
        $credito = $this->getCreditosPagos()->create($data);
        
        activity()
            ->causedBy(auth()->user())
            ->performedOn($credito)
            ->log("CREDITO CFC: CFC :subject.auto_escola_id foi pago, VALOR PAGO :subject.valor_pago");

        return $credito;
    }

    public function visualizarCreditos($auto_escola_id)
    {
        return $this->getCreditosPagos()
            ->with('autoEscola', 'creditos', 'creditos.aluno')
            ->join('auto_escola','credito_cfc_pagos.auto_escola_id','=','auto_escola.id')
            ->where(function ($query) use ($auto_escola_id){
                
                $query->where('credito_cfc_pagos.auto_escola_id', $auto_escola_id);
                
            })
            ->select('credito_cfc_pagos.*')
            ->get();
    }

    
}