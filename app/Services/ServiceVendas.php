<?php

namespace App\Services;

use App\Models\Servicos;
use App\Models\Venda;
use App\Models\Aluno;
use App\Models\Parcela;
use Carbon\Carbon;
use App\Services\ServiceVenda_servico;

class ServiceVendas
{

    /**
     * @var vendas
     */
    private $vendas;
    /**
     *
     */

    /**
     * @var ServiceAluno
     */
     private $aluno;
     private $serviceExames;
     private $boleto;
     private $receitas;
     private $parcelas;
     private $venda_servico;

    public function __construct(
        Venda $vendas, 
        ServiceAluno $aluno, 
        ServiceExames $serviceExames, 
        ServiceBoleto $boleto, 
        ServiceReceitas $receitas,
        ServiceParcelas $parcelas,
        ServiceVenda_servico $venda_servico
        )
   {
        $this->vendas = $vendas;
        $this->aluno =  $aluno;
        $this->serviceExames = $serviceExames;
        $this->boleto = $boleto;
        $this->receitas = $receitas;
        $this->parcelas = $parcelas;
        $this->venda_servico = $venda_servico;
   }

    /**
     * @return CentroCustos
     */
    public function getVendas()
    {
        return $this->vendas;
    }
        /**
     * @return ServiceAluno
     */
    public function ServiceAluno()
    {
        return $this->aluno;
    }

    public function serviceExames()
    {
        return $this->serviceExames;
    }

    public function serviceBoleto()
    {
        return $this->boleto;
    }

    public function serviceReceita()
    {
        return $this->receitas;
    }

    public function serviceParcela()
    {
        return $this->parcelas;
    }
    public function serviceVendaservico(){
        return $this->venda_servico;
    }


    public function vendasList()
    {
        return $this->getVendas()
            ->where('cfc_id', auth()->user()->cfc_selecionado)
            ->pluck('nome','id');
    }

    public function all()
    {
        return $this->getVendas()
        ->where('cfc_id', auth()->user()->cfc_selecionado)
        ->paginate();
    }
    public function show($id)
    {
        return $this->getVendas()->find($id);
    }
    public function vendaServico($data,$id,$venda_id){
       
        
        $alunos = $this->ServiceAluno()->show($id);

        foreach ($alunos->processos as $processo) 
        {   $categoria = $processo->categoria;
            $servico = $processo->servicos;
        }
        $nomevenda = $servico .':'.$categoria;

        $totaldesconto = 0;
        foreach ($data as $servicoData) 
        {   
            foreach ($servicoData as $servico) {
                $novoServico = [
                    'venda_id' => $venda_id,
                    'nome' => $servico['nome'],
                    'valor' => $servico['valor'],
                    'desconto' => $servico['desconto'],
                    'quantidade' => $servico['quantidade'],
                ];
                $totaldesconto = $servico['desconto'];
               $this->serviceVendaservico()->create($novoServico);
            }
        }
       
        return $vendaServico[] = ['nome' => $nomevenda,'desconto' => $totaldesconto];

    }
    public function create($data)
    {
    if (!isset($data['entrada'])) {$data['entrada'] = 0;}

    if (!isset($data['desconto'])){ $data['desconto'] = 0;}
   
            $data['cfc_id'] = auth()->user()->cfc_selecionado;
            $data['user_id'] = auth()->user()->id;
            $data['data_venda'] = Carbon::now();
            $data['quantidade_parcelas'] = $data['parcelas'];
            $data['desconto'] = moneyToFloat($data['desconto']);
            $data['valor_venda'] =  number_format($data['valor_venda'],2,'.','');
            $parcelaVenda['cfc_id'] = auth()->user()->cfc_selecionado;

            $venda = $this->getVendas()->create($data);

    if(isset($data['servicos'])){
        $venda_id = $venda->id;
        $id = $data['aluno_id'];
        $vendaServico = $this->vendaServico($data['servicos'],$id,$venda_id);
        $data['nome'] = $vendaServico['nome'];
        $data['desconto'] = $vendaServico['desconto'];
        $venda->nome = $data['nome'];
        $venda->save();
    }

         

    if ($data['forma_pagamento'] != 'Boleto') {

        if ($venda->forma_pagamento == 'Entrada + Parcelas') {
            $parcelaVenda['clinica_id'] = auth()->user()->clinica_selecionada;
            $parcelaVenda['venda_id'] = $venda->id;
            $parcelaVenda['data_pagamento'] = Carbon::now();
            $parcelaVenda['desconto'] = $data['desconto'];
            
            for ($i=0; $i < $data['parcelas']; $i++)
            {    $this->serviceParcela()->create($parcelaVenda);}

        }
        //cartão de credito
        if ($data['parcelas'] > 1 && $venda->forma_pagamento !='Entrada + Parcelas' ) {
            $parcelaVenda['venda_id'] = $venda->id;
            $parcelaVenda['data_pagamento'] = Carbon::now();
            $parcelaVenda['desconto'] = $data['desconto'];
            $parcelaVenda['valor_parcela'] = (moneyToFloat($data['valor_venda'])  -  moneyToFloat($data['desconto'])) / $data['parcelas'];
            
            for ($i=0; $i < $data['parcelas']; $i++) 
            {   $this->serviceParcela()->create($parcelaVenda);}
        } 

            //debito ou pagamentos a vista
        if($data['parcelas'] == null ){
            $parcelaVenda['valor_parcela'] = number_format(((moneyToFloat($data['valor_venda']) -  moneyToFloat($data['desconto']))), 2);
            $parcelaVenda['venda_id'] = $venda->id;
            $parcelaVenda['data_pagamento'] = Carbon::now();
            $parcelaVenda['desconto'] = $data['desconto'];

            $novaParcela =  $this->serviceParcela()->create($parcelaVenda);
            $parcela = $this->serviceParcela()->show($novaParcela['id']);
                    
                if($data['forma_pagamento'] == 'Auto Escola'){

                    $receita['valor'] = $parcela['valor_parcela'];
                    $receita['data_vencimento'] = Carbon::now()->addDays(30)->format('Y-m-d');
                    $receita['obs'] = 'Atendimento Auto Escola ||'.$parcela->venda->aluno->autoEscola->nome_fantasia;
                    $receita['aluno_id'] = $parcela->venda->aluno->id;
                    $receita['auto_escola_id'] = $parcela->venda->aluno->autoEscola->id;
                    $receita['parcela_id'] = $parcela->id;
                    $venda_id = $venda->id;

                        $this->serviceReceita()->create($receita);
                     // $this->serviceBoleto()->gerarBoleto($venda,$venda_id);
                }
        }
       
    }

        // $this->serviceExames()->create($venda['id'], $data['exames']);
       
        return $venda;
    }
  
    public function update($data, $id)
    {
        $data['cfc_id'] = auth()->user()->cfc_selecionado;
        return $this->getVendas()->find($id)->update($data);
    }
    public function delete($id)
    {
        return $this->getVendas()->find($id)->delete();
    }
}
