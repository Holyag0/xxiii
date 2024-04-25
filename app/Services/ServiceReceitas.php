<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Models\Receitas;
use Carbon\Carbon;

class ServiceReceitas
{

    /**
     * @var contasReceber
     */
    private $receitas;
    private $serviceTransacao;
    private $parcelas;

    public function __construct(Receitas $receitas, ServiceTransacao $serviceTransacao, ServiceParcelas $parcelas)
   {
       $this->receitas = $receitas;
       $this->serviceTransacao = $serviceTransacao;
       $this->parcelas = $parcelas;
   }

    /**
     * @return receitas
     */
    public function getReceitas()
    {
        return $this->receitas;
    }

    public function getTransacao()
    {
        return $this->serviceTransacao;
    }

    public function getParcela()
    {
        return $this->parcelas;
    }

    public function all()
    {
        return $this->getReceitas()
            ->with(['categoria', 'aluno', 'cfc'])
            ->where(function ($query){
                $query->where('cfc_id', auth()->user()->cfc_selecionado);
                $query->where('status', 0);
                if(auth()->user()->hasRole('Caixa')){
                    $query->where('user_id', auth()->user()->id);
                }
            })->paginate();
    }

    public function show($id)
    {
        return $this->getReceitas()
            ->with(['categoria', 'aluno', 'cfc'])
            ->where(function ($query){
                if (auth()->user()->hasRole('Caixa')) {
                    $query->where('user_id', auth()->user()->id);
                }
            })->find($id);
    }
    public function create($data)
    {
        $data['cfc_id'] = auth()->user()->cfc_selecionado;
        $data['user_id'] = auth()->user()->id;
        return $this->getReceitas()->create($data);
    }
    public function baixar($data)
    {
        if(isset($data['data_pagamento'])){
            $receitaAtualizada['data_pagamento'] = $data['data_pagamento'];
        }else{
            $receitaAtualizada['data_pagamento'] = Carbon::now();
            $data['data_pagamento'] = Carbon::now();
        }

        $transacao = $this->getTransacao()->create($data);

        if(isset($data['receitas'])){
            foreach($data['receitas'] as $receita)
            {
                if(isset($receita['cfc_id'])){
                    $parcela['status'] = 1;
                    $parcela['data_pagamento'] = $data['data_pagamento'];
                    $this->getParcela()->update($parcela, $receita['parcela_id']);
                }

                $receita = $this->show($receita['id']);

                $receitaAtualizada['status'] = 1;
                $receitaAtualizada['transacao_id'] = $transacao->id;
                $receita->update($receitaAtualizada);
            }
        }else{
            $receita = $this->show($data['receita_id']);

            if(isset($receita['cfc_id'])){
                $parcela['status'] = 1;
                $parcela['data_pagamento'] = $data['data_pagamento'];
                $this->getParcela()->update($parcela, $receita['parcela_id']);
            }

            $receita = $this->show($data['receita_id']);
            $receitaAtualizada['status'] = 1;
            $receitaAtualizada['transacao_id'] = $transacao->id;
            $receitaAtualizada['valor'] = $transacao['valor'];
            $receita->update($receitaAtualizada);
        }
        

        return $transacao;
    }
    public function update($data, $id)
    {
        $data['cfc_id'] = auth()->user()->cfc_selecionado;
        return $this->getReceitas()->find($id)->update($data);
    }

    public function reabrir($id)
    {
        $receita = $this->getReceitas()->find($id);

        $this->getTransacao()->deleteTransacaoByReceita($receita);

        $data['status'] = 0;
        $data['data_pagamento'] = null;
        $data['transacao_id'] = null;
        $receita = $this->getReceitas()->find($id)->update($data);

        return $receita;
    }
    public function delete($id)
    {
        return $this->getReceitas()->find($id)->delete();
    }

    public function search($data)
    {
        return $this->getReceitas()
            ->with('categoria','aluno')
            ->join('alunos','receitas.aluno_id','=','alunos.id')
            ->where(function ($query) use ($data){

                $query->where('receitas.cfc_id', auth()->user()->cfc_selecionado);

                if (auth()->user()->hasRole('Caixa')) {
                    $query->where('receitas.user_id', auth()->user()->id);
                }

                if (isset($data['data_inicio']) AND isset($data['data_fim']) AND $data['status'] != 1) {
                    $query->wherebetween('receitas.data_vencimento', [$data['data_inicio'], $data['data_fim']]);
                    
                }

                if (isset($data['data_inicio']) AND isset($data['data_fim']) AND $data['status'] == 1) {
                    $query->wherebetween('receitas.data_pagamento', [$data['data_inicio'], $data['data_fim']]);
                   
                }

                if (isset($data['cliente'])) {
                    $nome = $data['cliente'];
                    $query->where('alunos.nome', 'LIKE', "%{$nome}%");
                }

                if (isset($data['cfc_id'])) {
                    $cfc_id = $data['cfc_id'];
                    $query->where('receitas.cfc_id', $cfc_id);
                }

                if (isset($data['status'])) {
                    $query->where('receitas.status', $data['status']);
                    
                }

                if (isset($data['categoria_id'])) {
                    $categoria_id = $data['categoria_id'];
                    $query->where('receitas.categoria_id', $categoria_id);
                }

            })
            ->select('receitas.*')
            ->paginate();

    }
    public function relatorio($data)
    {
        dd($data);
        return $this->getReceitas()
            ->with('categoria','aluno')
            ->join('alunos','receitas.aluno_id','=','alunos.id')
            ->where(function ($query) use ($data){

                $query->where('receitas.cfc_id', auth()->user()->cfc_selecionado);

                if (isset($data['data_inicio']) AND isset($data['data_fim']) AND isset($data['status']) != 1) {
                    $query->wherebetween('receitas.data_vencimento', [$data['data_inicio'], $data['data_fim']]);
                   
                }

                // if (isset($data['data_inicio']) AND isset($data['data_fim']) AND isset($data['status']) == 1) {
                //     $query->wherebetween('receitas.data_pagamento', [$data['data_inicio'], $data['data_fim']]);
                //     dd('?');
                // }

                if (isset($data['status'])) {
                    
                    $query->where('receitas.status', $data['status']);
                }

                if (isset($data['categoria_id'])) {
                    $categoria_id = $data['categoria_id'];
                    $query->where('receitas.categoria_id', $categoria_id);
                }
            })
            ->select('*')
            ->get();

    }

    public function somatorioReceitas($receitas)
    {
        $valorTotal = 0;
        foreach($receitas as $receita){
            $valorTotal += $receita['valor'];
        }

        return $valorTotal;
    }
}
