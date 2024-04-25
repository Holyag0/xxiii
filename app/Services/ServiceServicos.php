<?php

namespace App\Services;

use App\Models\Servicos;


class ServiceServicos
{

    /**
     * @var Servicos
     */
    private $servicos;

    public function __construct(Servicos $servicos)
   {
       $this->servicos = $servicos;
   }

    /**
     * @return Servicos
     */
    public function getServicos()
    {
        return $this->servicos;
    }


    public function servicoList()
    {
        $servicos = $this->getServicos()
        ->where('cfc_id',auth()->user()->cfc_selecionado)
        ->get();

        $pluckServicos = [];

        foreach($servicos as $servico){
            $pluckServicos[$servico->id] = $servico->nome." | ". floatToMoney($servico->valor);
        }

        return $pluckServicos;
    }
    public function getServicoByProcesso($categoria){
        return $this->getServicos()
        ->where('cfc_id',auth()->user()->cfc_selecionado)
        ->where('categoria', $categoria)
        ->paginate();
    }

    public function all()
    {
        return $this->getServicos()
            ->where('cfc_id',auth()->user()->cfc_selecionado)
            ->orderBy('id','desc')
            ->paginate();
    }
    public function show($id)
    {
        return $this->getServicos()->find($id);
    }
    public function create($data)
    {
        $data['cfc_id'] = auth()->user()->cfc_selecionado;
        $servico = $this->getServicos()->create($data);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($servico)
            ->log("SERVIÇO: :subject.nome foi criado");

        return $servico;
    }
    public function update($data, $id)
    {
        $data['cfc_id'] = auth()->user()->cfc_selecionado;
        $servico = $this->getServicos()->find($id);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($servico)
            ->log("SERVIÇO: :subject.nome foi alterado");

        return $servico->update($data);
    }
    public function delete($id)
    {
        $servico = $this->getServicos()->find($id);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($servico)
            ->log("SERVIÇO: :subject.nome foi deletado");

        $servico->delete();
    }
}