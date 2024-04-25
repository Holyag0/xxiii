<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Models\Transacao;
use App\Models\Transferencias;
use Carbon\Carbon;

class ServiceTransferencias
{

    /**
     * @var transacao
     */
    private $transferencias;
    private $serviceContas;

    public function __construct(Transferencias $transferencias, ServiceContasDigitais $serviceContas)
   {
       $this->transferencias = $transferencias;
       $this->serviceContas = $serviceContas;
   }

    public function getTransferencias()
    {
        return $this->transferencias;
    }

    public function getServiceContas()
    {
        return $this->serviceContas;
    }

    public function all()
    {
        return $this->getTransferencias()
            ->with(['contaOrigem', 'contaDestino'])
            ->orderBy('id','desc')
            ->paginate();
    }

    public function transferir($data)
    {
        $contaOrigem = $this->getServiceContas()->show($data['conta_origem']);
        $contaDestino = $this->getServiceContas()->show($data['conta_destino']);

        $contaOrigem->update([
            'saldo_atual' => $contaOrigem->saldo_atual -= moneyToFloat($data['valor']),
        ]);

        $contaDestino->update([
            'saldo_atual' => $contaDestino->saldo_atual += moneyToFloat($data['valor']),
        ]);

        if($contaOrigem){
            $contaOrigem->transacoes()->create([
                'data_pagamento' => $data['data_transferencia'],
                'tipo' => 'Despesa',
                'cfc_id' => auth()->user()->cfc_selecionado,
                'forma_pagamento' => 'Transferencia',
                'valor' => moneyToFloat($data['valor']),
                'favorecido' => $contaOrigem->nome,
            ]);
        }

        if($contaDestino){
            $contaDestino->transacoes()->create([
                'data_pagamento' => $data['data_transferencia'],
                'tipo' => 'Entrada',
                'cfc_id' => auth()->user()->cfc_selecionado,
                'forma_pagamento' => 'Transferencia',
                'valor' => moneyToFloat($data['valor']),
                'favorecido' => $contaDestino->nome,
            ]);
        }

        $data['valor'] = moneytoFloat($data['valor']);
        $transferencia = $this->getTransferencias()->create($data);

        return $transferencia;
    }
}
