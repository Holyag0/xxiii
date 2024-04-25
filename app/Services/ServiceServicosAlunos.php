<?php

namespace App\Services;

use App\Models\Servicos;
use App\Models\ServicosAlunos;

class ServiceServicosAlunos
{

    /**
     * @var Servicos
     */
    private $servicos;
    /**
     * @var ServiceAluno
     */
    private $alunos;

    public function __construct(ServicosAlunos $servicos, ServiceAluno $alunos)
   {
       $this->servicos = $servicos;
       $this->alunos = $alunos;
   }

    /**
     * @return Servicos
     */
    public function getServicos()
    {
        return $this->servicos;
    }
    /**
     * @return Alunos
     */
    public function getAlunos()
    {
        return $this->alunos;
    }


    public function servicoList()
    {
        return $this->getServicos()->pluck('nome','id');
    }

    public function all()
    {
        return $this->getServicos()->get();
    }
    public function show($id)
    {
        $servicos = $this->getServicos()
        ->where('aluno_id',$id)
        ->get();

        return $servicos;

    }
    public function create($data)
    {
        return $this->getServicos()->create($data);
    }
    public function update($data, $id)
    {
        return $this->getServicos()->find($id)->update($data);
    }
    public function delete($id)
    {
        return $this->getServicos()->find($id)->delete();
    }
    public function situacao($data)
    {
        dd($data);
        $aluno = $this->getAlunos()->show($data['aluno_id']);
     
        foreach($aluno->servicos as $servico)
        {

            $dados = $this->getServicos()
            ->where('aluno_id',$data['aluno_id'])
            ->where('servico_id',$servico_id)
            ->first();
        }

        dd($dados);
        
    }
}