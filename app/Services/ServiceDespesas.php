<?php

namespace App\Services;

use App\Models\Servicos;
use App\Models\Categoria;
use App\Models\Despesas;
use Carbon\Carbon;

class ServiceDespesas
{

    /**
     * @var Despesas
     */
    private $despesas;
    private $transacao;
    /**
     *
     */
  //  private $alunos;

    public function __construct(Despesas $despesas, ServiceTransacao $transacao)
   {
       $this->despesas = $despesas;
       $this->transacao = $transacao;

   }

    /**
     * @return Despesas
     */
    public function getDespesas()
    {
        return $this->despesas;
    }
    public function getTransacao()
    {
        return $this->transacao;
    }

    public function despesasList()
    {
        return $this->getDespesas()
            ->where('cfc_id', auth()->user()->cfc_selecionado)
            ->pluck('nome','id');
    }

    public function all()
    {
        return $this->getDespesas()
            ->with(['fornecedor', 'centroCusto'])
            ->where(function ($query){
                $query->where('cfc_id', auth()->user()->cfc_selecionado);
                if(auth()->user()->hasRole('Caixa')){
                    $query->where('user_id', auth()->user()->id);
                }
            })->paginate();
    }
    public function find($id)
    {
        return $this->getDespesas()
            ->with(['fornecedor', 'centroCusto'])
            ->where(function ($query){
                if(auth()->user()->hasRole('Caixa')){
                    $query->where('user_id', auth()->user()->id);
                }
            })->find($id);
    }
    public function create($data)
    {
        $data['cfc_id'] = auth()->user()->cfc_selecionado;
        $data['user_id'] = auth()->user()->id;

        return $this->getDespesas()->create($data);
    }
    public function show($id)
    {
        return $this->getDespesas()->find($id);
    }
    public function update($data, $id)
    {
        $data['cfc_id'] = auth()->user()->cfc_selecionado;
        $data['user_id'] = auth()->user()->id;
        return $this->getDespesas()->find($id)->update($data);
    }
    public function delete($id)
    {
        return $this->getDespesas()->find($id)->delete();
    }

    public function baixar($data)
    {
        if(isset($data['data_pagamento'])){
            $despesaAtualizada['data_pagamento'] = $data['data_pagamento'];
        }else{
            $despesaAtualizada['data_pagamento'] = Carbon::now();
            $data['data_pagamento'] = Carbon::now();
        }

        $transacao = $this->getTransacao()->create($data);

        $despesa = $this->find($data['despesa_id']);
        $despesaAtualizada['status'] = 1;
        $despesaAtualizada['transacao_id'] = $transacao->id;
        $despesaAtualizada['valor'] = $transacao['valor'];
        $despesa->update($despesaAtualizada);

        return $transacao;
    }

    public function reabrir($id)
    {
        $despesa = $this->getDespesas()->find($id);
        $this->getTransacao()->deleteTransacaoByDespesa($despesa);

        $data['status'] = 0;
        $data['transacao_id'] = null;
        $data['data_pagamento'] = null;
        $despesa = $this->getDespesas()->find($id)->update($data);

        return $despesa;
    }

    public function search($data)
    {
        return $this->getDespesas()
            ->with('centroCusto','fornecedor')
            ->join('centro_custos','despesas.centro_custo_id','=','centro_custos.id')
            ->join('fornecedores','despesas.fornecedor_id','=','fornecedores.id')
            ->where(function ($query) use ($data){

                $query->where('despesas.cfc_id', auth()->user()->cfc_selecionado);

                if(auth()->user()->hasRole('Caixa')){
                    $query->where('despesas.user_id', auth()->user()->id);
                }

                if (isset($data['data_inicio']) AND isset($data['data_fim']) AND $data['status'] != 1) {
                    $query->wherebetween('despesas.data_vencimento', [$data['data_inicio'], $data['data_fim']]);
                }

                if (isset($data['data_inicio']) AND isset($data['data_fim']) AND $data['status'] == 1) {
                    $query->wherebetween('despesas.data_pagamento', [$data['data_inicio'], $data['data_fim']]);
                }

                if (isset($data['fornecedor'])) {
                    $nome = $data['fornecedor'];
                    $query->where('fornecedores.nome', 'LIKE', "%{$nome}%");
                }

                if (isset($data['status'])) {
                    $query->where('despesas.status', $data['status']);
                }

                if (isset($data['centro_custo_id'])) {
                    $centro_custo_id = $data['centro_custo_id'];
                    $query->where('centro_custos.id', $centro_custo_id);
                }

            })
            ->select('despesas.*')
            ->paginate();

    }
    public function relatorio($data){
       
    //    $data ['data_inicio'] = Carbon::now()->settings(['locale' => 'pt_BR', 'timezone' => 'America/Sao_Paulo',])->subDay(2)->format('d-m-Y') ;
      
    //   dd($data);
        return $this->getDespesas()
        ->with('centroCusto','fornecedor')
        ->join('centro_custos','despesas.centro_custo_id','=','centro_custos.id')
        ->join('fornecedores','despesas.fornecedor_id','=','fornecedores.id')
        ->where(function ($query) use ($data){

            $query->where('despesas.cfc_id', auth()->user()->cfc_selecionado);

            if (isset($data['data_inicio']) AND isset($data['data_fim']) AND $data['status'] != 1) {
                $query->wherebetween('despesas.data_vencimento', [$data['data_inicio'], $data['data_fim']]);
            }

            if (isset($data['data_inicio']) AND isset($data['data_fim']) AND $data['status'] == 1) {
                $query->wherebetween('despesas.data_pagamento', [$data['data_inicio'], $data['data_fim']]);
            }

            if (isset($data['fornecedor'])) {
                $nome = $data['fornecedor'];
                $query->where('fornecedores.nome', 'LIKE', "%{$nome}%");
            }

            if (isset($data['status'])) {
                $query->where('despesas.status', $data['status']);
            }

            if (isset($data['centro_custo_id'])) {
                $centro_custo_id = $data['centro_custo_id'];
                $query->where('centro_custos.id', $centro_custo_id);
            }

        })
        ->select('despesas.*')
        ->paginate();


    }
    public function notificationPainel(){
       $data[''] = 0;
       $data ['data_inicio'] = Carbon::now()->subDay(2) ;
       $data ['data_fim'] = Carbon::now()->addDays(2) ;
        return $this->getDespesas()
        ->with(['fornecedor', 'centroCusto'])
        ->where(function ($query) use ($data){
            $query->where('cfc_id', auth()->user()->cfc_selecionado);
            if(auth()->user()->hasRole('Caixa')){
                $query->where('user_id', auth()->user()->id);
            }
            $query->wherebetween('despesas.data_vencimento', [$data['data_inicio'], $data['data_fim']]);
        })->paginate();
    }
}
