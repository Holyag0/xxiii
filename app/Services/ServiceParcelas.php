<?php

namespace App\Services;

use App\Models\Servicos;
use App\Models\Parcela;
use App\Models\Venda;

class ServiceParcelas
{

    /**
     * @var Cantegorias
     */
    private $parcelas;
    private $serviceTransacao;
    private $vendas;
    /**
     *
     */
  //  private $alunos;

    public function __construct(Parcela $parcelas, ServiceTransacao $serviceTransacao,Venda $vendas)
   {
       $this->parcelas = $parcelas;
       $this->serviceTransacao = $serviceTransacao;
       $this->vendas = $vendas;
   }

    /**
     * @return CentroCustos
     */
    public function getParcelas()
    {
        return $this->parcelas;
    }

    public function getTransacao()
    {
        return $this->serviceTransacao;
    }

    public function getVendas(){
        return $this->vendas;
    }
    public function parcelaList()
    {
        return $this->getParcelas()
            ->where('clinica_id', auth()->user()->clinica_selecionada)
            ->pluck('name','id');
    }

    public function all()
    {
        return $this->getParcelas()
        ->where('clinica_id', auth()->user()->clinica_selecionada)
        ->paginate();
    }
    public function show($id)
    {
        return $this->getParcelas()
        ->with('venda', 'venda.aluno')
        ->find($id);
    }
    public function create($data)
    {
        $data['clinica_id'] = auth()->user()->clinica_selecionada;
        return $this->getParcelas()->create($data);
    }
    public function update($data, $id)
    {
        $data['clinica_id'] = auth()->user()->clinica_selecionada;
        return $this->getParcelas()->find($id)->update($data);
    }
    public function delete($id)
    {
        return $this->getParcelas()->find($id)->delete();
    }

    public function baixarParcela($data, $id)
    {     
           $parcelas= $this->getParcelas()->find($id);
           $venda = $this->getVendas()->find($parcelas->venda_id);
        if($venda->forma_pagamento == 'Entrada + Parcelas')
            {    $data['valor'] = moneyToFloat($data['valor']);
                  $parcelas->valor_parcela = number_format($data['valor'],2,'.','');          
            }
            $transacao = $this->getTransacao()->create($data);  
            $data['transacao_id'] = $transacao->id;
            $updateResult = $parcelas->update($data);

            $parcela_vendas = $this->getParcelas()->where('venda_id', $parcelas->venda_id)->get();
            $allPaid = true;
            foreach($parcela_vendas as $parcela){
                if ($parcela->status != 1){
                    $allPaid = false;
                    break;
                }
            }
        
            if ($allPaid) {
                $venda->status = 'Pago';
                $venda->save();
            }
           
        return $updateResult;
    }

    public function reabrir($data, $id){
        $parcelas = $this->getParcelas()->find($id);
        $venda = $this->getVendas()->find($parcelas->venda_id);
        if($venda->forma_pagamento == 'Entrada + Parcelas')
            {
                $parcelas->valor_parcela = null;
            } 
        $data['status'] = 0;
        $data['data_pagamento'] = null;
        $data['transacao_id'] = $parcelas->transacao_id;
        $this->getTransacao()->deleteTransacaoByReceita($data);

        $data['transacao_id'] = null;
        return $this->getParcelas()->find($id)->update($data);
          
    }

    public function deleteParcelasByVendas($data){
        return $this->getParcelas()->where('venda_id',$data)->delete();
    }

}
