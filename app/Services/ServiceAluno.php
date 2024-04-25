<?php

namespace App\Services;

use App\Models\Aluno;
use App\Models\Exame;
use App\Services\ServiceBoleto;
use App\Services\ServiceExames;

class ServiceAluno
{

    /**
     * @var Aluno
     */
    private $aluno;

    /**
     * @var ServiceBoleto
     */
    private $boleto;
     /**
     * @var ServiceExames
     */
    private $exames;

    /**
     * @var ServiceTransacao
     */
    private $transacao;

    private $serviceContas;

    public function __construct(
        Aluno $aluno,
        ServiceBoleto $boleto,
        ServiceTransacao $transacao,
        ServiceContasDigitais $serviceContas,
        ServiceExames $exames,
        Exame $exame
    )
   {
       $this->aluno = $aluno;
       $this->boleto = $boleto;
       $this->transacao = $transacao;
       $this->serviceContas = $serviceContas;
       $this->exames = $exames;
       $this->exame = $exame;
   }

    /**
     * @return aluno
     */
    public function getAluno()
    {
        return $this->aluno;
    }
    /**
     * @return getServiceExames
     */
    public function getServiceExames()
    {
        return $this->exames;
    }

     /**
     * @return getServiceBoleto
     */
    public function getServiceBoleto()
    {
        return $this->boleto;
    }

    public function getTransacao()
    {
        return $this->transacao;
    }

    public function getContas()
    {
        return $this->serviceContas;
    }

    public function alunoList()
    {
        return $this->getAluno()
            ->where('cfc_id', auth()->user()->cfc_selecionado)
            ->pluck('nome','id');
    }

    public function all()
    {
        if(auth()->user()->hasRole('Auto Escola'))
        {
            return $this->getAluno()
                ->with('cfc')
                ->where('cfc_id',auth()->user()->cfc_selecionado)
                //->where('status','<>','Aprovado')
                ->orderBy('id','desc')
                ->paginate();
        }else if(auth()->user()->hasRole('Avulso')){
            return $this->getAluno()
                ->where('cfc_id',auth()->user()->cfc_selecionado)
                ->where('avulso_id',auth()->user()->id)
                //->where('status','<>','Aprovado')
                ->orderBy('id','desc')
                ->paginate();
        }else{
            return $this->getAluno()
                ->with('cfc')
                //->where('status','<>','Aprovado')
                ->where('cfc_id', auth()->user()->cfc_selecionado)
                ->orderBy('alunos.id','desc')
                ->paginate();
        }
    }
    public function recibo($id)
    {
        return $this->getAluno()->with(['clinica', 'vendas','vendas.user','vendas.parcelas','vendas.boleto', 'vendas.exames','vendas.exames.exameTeste'])->find($id);    
    }

    public function show($id)
    {
        return $this->getAluno()->with(['processos','cfc', 'vendas','vendas.vendaServico','vendas.pacote.servicos','vendas.user','vendas.parcelas','vendas.boleto', 'vendas.exames','vendas.exames.exameTeste'])->find($id);    
    }

    public function create($data)
    {   
        if(auth()->user()->hasRole(['Auto Escola']) || auth()->user()->hasRole(['Admin'])){
            
            $data['cfc_id'] = auth()->user()->cfc_selecionado;
        }

       
        $aluno = $this->getAluno()->create($data);
       
        activity()
                ->causedBy(auth()->user())
                ->performedOn($aluno)
                ->log("ALUNO: Aluno :subject.nome foi criado, CPF :subject.cpf");

        return $aluno;
    }

    public function update($data, $id)
    {
        $aluno = $this->getAluno()->find($id);

        $this->getAluno()->find($id)->update($data);

        $aluno = $this->getAluno()->find($id);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($aluno)
            ->log("ALUNO: Aluno :subject.nome foi alterado, CPF :subject.cpf");

       return $aluno;
    }

    public function delete($id)
    {
        $aluno = $this->getAluno()->find($id);

        activity()
                ->causedBy(auth()->user())
                ->performedOn($aluno)
                ->log("ALUNO: Aluno :subject.nome foi deletado, CPF :subject.cpf");

        return $aluno->delete();
    }

    public function search($search)
    {
        return $this->getAluno()
            ->with('clinica','cfc','vendas','vendas.user','vendas.parcelas','vendas.boleto', 'vendas.exames','vendas.exames.exameTeste')
            ->where(function ($query) use ($search)
            {

                if(auth()->user()->hasRole('Clinica')){
                    $query->where('cfc_id',auth()->user()->cfc_selecionado);
                }

                if (isset($search['nome'])) {
                    $filter = $search['nome'];
                    $query->where(function ($querySub) use ($filter) {
                        $querySub->where('nome', 'LIKE', "%{$filter}%");
                       
                    });
                }

                if (isset($search['cpf'])) {
                    $filter =  $search['cpf'];
                    $query->where(function ($querySub) use ($filter) {
                        $querySub->where('cpf', 'LIKE', "%{$filter}%");
                    });
                }

                if (isset($search['status'])) {
                    $status = $search['status'];
                    $query->whereHas('exame.status', 'LIKE', "%{$status}%"
                
                );
                }

               if (isset($search['cfc'])) {
                    $query->where('alunos.cfc_id', $search['cfc']);

                }
                if ($search['data_inicio'] AND $search['data_fim']) {
                    $query->whereBetween('alunos.created_at', [$search['data_inicio']." 00:00:00", $search['data_fim']." 23:59:59"]);
                   }
            })
            ->select('*')
            ->paginate();
           
    }

    public function atualizaStatusFinal($aluno)
    {
        $servicos = $aluno->servicos()->get();
        $status = [];
        $aprovado = true;

        foreach($servicos as $servico){
            array_push($status, $servico->pivot->status);
        }
        if(in_array('Inapto Temporariamente',$status)){
            return $aluno->update(['status'=>'Inapto Temporariamente']);
        }

        foreach($servicos as $servico){
            if($servico->pivot->status != "Aprovado")
            {
                $aprovado = false;
            }
        }

        if($aprovado){
            return $aluno->update(['status'=>'Aprovado']);
        }else{
            return $aluno->update(['status'=>'Alguns exames ainda não foram feitos']);
        }
    }

    public function relatorio($data)
    {     
        
            return $this->getAluno()
           
            ->join('auto_escola','alunos.cfc_id','=','auto_escola.id')
            
            ->where(function ($query) use ($data){
             

                if ($data['data_inicio'] AND $data['data_fim']) {
                    $query->orwherebetween('alunos.created_at', [$data['data_inicio'], $data['data_fim']]);
                }

                // if (isset($data['tipo'])) {
                //     $query->where('alunos.tipo', $data['tipo']);
                // }

                if(auth()->user()->hasRole('Clinica')){
                    $query->where('alunos.cfc_id',auth()->user()->cfc_id);
                 }
                if(auth()->user()->hasRole('Avulso')){
                    $query->where('alunos.avulso_id',auth()->user()->id);
                }
                if(auth()->user()->hasRole('Auto Escola')){
                   
                    $query->where('alunos.cfc_id',auth()->user()->cfc_id);
                }
                 if (isset($data['cfc_id'])) {
                    
                    $query->where('alunos.cfc_id', $data['cfc_id']);
                }


            })
             ->select('alunos.*')
             ->paginate();
        // }else{
        //     return $this->getAluno()->with('pagamento')
        //     ->join('servicos_alunos', 'alunos.id', '=', 'servicos_alunos.aluno_id')
        //     ->where(function ($query) use ($data){

        //         if (isset($data['financeiro'])) {

        //             if($data['financeiro'] == 'pendente')
        //             {
        //                 $query->where(['alunos.boleto_status_pagamento' =>  NULL]);
        //             }

        //             if($data['financeiro'] == 'boleto_pendente')
        //             {
        //                 $query->where(['alunos.boleto_status_pagamento' =>  'pending']);
        //             }

        //             if($data['financeiro'] == 'boleto_cancelado')
        //             {
        //                 $query->where(['alunos.boleto_status_pagamento' =>  'canceled']);
        //             }

        //             if($data['financeiro'] == 'paid')
        //             {
        //                 $query
        //                     ->where(function ($query){
        //                         $query->where('alunos.boleto_status_pagamento',"paid");
        //                         $query->orWhere('alunos.boleto_status_pagamento',"completed");
        //                     });
        //             }
        //         }

        //         if (isset($data['cfc'])) {
        //             $query->where('alunos.cfc_id', $data['cfc']);
        //         }


        //         if(auth()->user()->hasRole('Avulso')){
        //             $query->where('alunos.avulso_id',auth()->user()->id);
        //         }
        //         if(auth()->user()->hasRole('Auto Escola')){
        //             $query->where('alunos.cfc_id',auth()->user()->cfc_id);
        //         }

        //         if (isset($data['status']) && $data['status'] == 'A fazer') {
        //             $query->where('alunos.status', $data['status']);
        //             if ($data['data_inicio'] AND $data['data_fim']) {
        //                 $query->whereBetween('alunos.created_at', [$data['data_inicio']." 00:00:00", $data['data_fim']." 23:59:59"]);
        //             }
        //         }

        //         if (isset($data['status']) && $data['status'] == 'Remarcado') {
        //             $query->where('servicos_alunos.status', $data['status']);
        //             if ($data['data_inicio'] AND $data['data_fim']) {
        //                 $query->whereBetween('servicos_alunos.data_remarcacao', [$data['data_inicio']." 00:00:00", $data['data_fim']." 23:59:59"]);
        //             }
        //         }

        //         if (isset($data['status']) && $data['status'] != 'A fazer') {
        //             if ($data['data_inicio'] AND $data['data_fim']) {
        //                 $query->whereBetween('servicos_alunos.data_exame', [$data['data_inicio']." 00:00:00", $data['data_fim']." 23:59:59"]);
        //             }
        //             $query->where('servicos_alunos.status', $data['status']);
        //         }


        //     })
            // ->orderBy('alunos.id','desc')
            // ->get();
        
    }
}
