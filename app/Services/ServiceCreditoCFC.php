<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Models\CreditoCFC;

class ServiceCreditoCFC
{

    private $creditoCFC;
    private $creditoPago;
    private $boleto;

    public function __construct(CreditoCFC $creditoCFC, ServiceCreditoCFCPagos $creditoPago, ServiceBoleto $boleto)
   {
       $this->creditoCFC = $creditoCFC;
       $this->creditoPago = $creditoPago;
       $this->boleto = $boleto;
   }

    /**
     * @return Voucher
     */
    public function getCreditoCFC()
    {
        return $this->creditoCFC;
    }
    public function getCreditoPago()
    {
        return $this->creditoPago;
    }
    public function getBoleto()
    {
        return $this->boleto;
    }

    public function all()
    {
        return $this->getCreditoCFC()
            ->where('status',0)
            ->orderBy('id','desc')
            ->paginate();
    }

    public function show($id)
    {
        return $this->getCreditoCFC()->find($id);
    }

    public function inserirCreditosByBoleto($boleto_id)
    {
        $boleto = $this->getBoleto()->find($boleto_id);

        if($boleto){
            $credito['cfc_id'] = $boleto->cfc_id;
            $credito['auto_escola_id'] = $boleto->venda->aluno->autoEscola->id; 
            $credito['aluno_id'] = $boleto->venda->aluno->id; 
            $credito['valor_pacote'] = moneyToFloat($boleto->venda->valor_venda) - moneyToFloat($boleto->venda->desconto); 
            $credito['boleto_id'] = $boleto_id;
            $credito['valor_credito'] = $boleto->venda->pacote->valor_credito;
    
            $this->getCreditoCFC()->create($credito);
        }
        
    }

    public function aprovarCreditoAutoEscola($data)
    {
        $creditoPago = $this->getCreditoPago()->create($data);

        foreach($data['relacaoCreditos'] as $credito){
            
            $creditocfc['status'] = 1;
            $creditocfc['credito_pago_id'] = $creditoPago['id'];
            
            $this->update($creditocfc, $credito['id']);
        }

        return $creditoPago;
    }

    public function update($data, $id)
    {
        $creditoCFC = $this->getCreditoCFC()->find($id);

        return $creditoCFC->update($data);
    }

    public function visualizarCreditos($auto_escola_id)
    {
        return $this->getCreditoCFC()
            ->with('autoEscola', 'aluno', 'boleto', 'boleto.venda' ,'boleto.venda.pacote')
            ->join('auto_escola','credito_cfc.auto_escola_id','=','auto_escola.id')
            ->where(function ($query) use ($auto_escola_id){

                $query->where('credito_cfc.cfc_id', auth()->user()->cfc_selecionado);
                
                $query->where('credito_cfc.auto_escola_id', $auto_escola_id);

                $query->where('credito_cfc.status', 0);
                
            })
            ->select('credito_cfc.*')
            ->get();
    }

    public function somaCreditos($creditos)
    {
        $valorCredito = 0;

        foreach($creditos as $credito){
            $valorCredito += $credito->valor_credito; 
        }

        dd($valorCredito);
    }

}
