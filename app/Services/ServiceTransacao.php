<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Models\Transacao;
use Carbon\Carbon;

class ServiceTransacao
{

    /**
     * @var transacao
     */
    private $transacao;
    private $serviceContas;

    public function __construct(Transacao $transacao, ServiceContasDigitais $serviceContas)
   {
       $this->transacao = $transacao;
       $this->serviceContas = $serviceContas;
   }

    /**
     * @return transacao
     */
    public function getTransacao()
    {
        return $this->transacao;
    }

    public function getServiceContas()
    {
        return $this->serviceContas;
    }

    public function all()
    {
        return $this->getTransacao()
        ->with('conta')
        ->orderBy('data_pagamento','desc')
        ->where(function ($query){
            if(auth()->user()->hasRole('Caixa')){
                $query->where('user_id', auth()->user()->id);
            }
        })->paginate();
    }

    public function byConta($id)
    {
        return $this->getTransacao()
            ->where('conta_id',$id)
            ->where('data_pagamento',Carbon::now()->format('Y-m-d'))
            ->orderBy('tipo','desc')
            ->paginate();
    }

    public function search($data)
    {
        return $this->getTransacao()
            ->with('conta')
            ->where(function ($query) use ($data) {
                if (isset($data['data_inicio']) AND isset($data['data_fim'])) {
                    $query->whereBetween('data_pagamento', [$data['data_inicio'], $data['data_fim']]);
                }

                if (isset($data['conta_id'])) {
                    $query->where('conta_id',$data['conta_id']);
                }

                if(auth()->user()->hasRole('Caixa')){
                    $query->where('user_id', auth()->user()->id);
                }
                
            })
            ->orderBy('data_pagamento','desc')
            ->paginate();
    }
    public function show($id)
    {
        return $this->getTransacao()->find($id);
    }
    public function create($data)
    {
        $contaDigital = $this->getServiceContas()->show($data['conta_id']);
        $valor = [];

        if($data['tipo'] == 'Receita'){
            $valor['saldo_atual'] = $contaDigital->saldo_atual += moneyToFloat($data['valor']);
        }elseif($data['tipo'] == 'Despesa'){
            $valor['saldo_atual'] = $contaDigital->saldo_atual -= moneyToFloat($data['valor']);
        }

        $contaDigital->update($valor);

        $data['data_pagamento'] = Carbon::parse($data['data_pagamento'])->format('Y-m-d');
        $data['cfc_id'] = auth()->user()->cfc_selecionado;
        $data['user_id'] = auth()->user()->id;

        return $this->getTransacao()->create($data);
    }
    public function update($data, $id)
    {
        $clinica = $this->getTransacao()->find($id);

        return $clinica->update($data);
    }

    public function deleteTransacaoByReceita($data)
    {
        $valor = [];
        $transacao = $this->getTransacao()->find($data['transacao_id']);
        $contaDigital = $this->getServiceContas()->show($transacao['conta_id']);
        
        
        $valor['saldo_atual'] = $contaDigital->saldo_atual -= moneyToFloat($transacao['valor']);

        $contaDigital->update($valor);

        return $transacao->delete();
    }

    public function deleteTransacaoByDespesa($data)
    {
        $valor = [];
        $transacao = $this->getTransacao()->find($data['transacao_id']);
        $contaDigital = $this->getServiceContas()->show($transacao['conta_id']);
        
        $valor['saldo_atual'] = $contaDigital->saldo_atual += moneyToFloat($transacao['valor']);

        $contaDigital->update($valor);

        return $transacao->delete();
    }

    public function somatorio_receitas($transacoes)
    {
        $valor_total = 0;

        foreach($transacoes as $transacao){
            if($transacao->tipo == "Receita")
            {
                $valor_total += $transacao->valor;
            }
        }

        return $valor_total;
    }

    public function somatorio_despesas($transacoes)
    {
        $valor_total = 0;

        foreach($transacoes as $transacao){
            if($transacao->tipo == "Despesa")
            {
                $valor_total += $transacao->valor;
            }
        }

        return $valor_total;
    }
}
