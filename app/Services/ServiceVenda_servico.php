<?php

namespace App\Services;

use App\Models\Servicos;
use App\Models\Venda_servico;

class ServiceVenda_servico
{

    /**
     * 
     */
    private $vendaServico;
    /**
     *
     */
  //  private $alunos;

    public function __construct(Venda_servico $vendaServico)
   {
       $this->vendaServico = $vendaServico;

   }

    /**
     * 
     */
    public function getvendaServico()
    {
        return $this->vendaServico;
    }

    public function vendaServicoList()
    {
        return $this->getvendaServico()
            ->where('cfc_id', auth()->user()->cfc_selecionado)
            ->pluck('nome','id');
    }

    public function all()
    {
        return $this->getvendaServico()
        ->where('cfc_id', auth()->user()->cfc_selecionado)
        ->paginate();
    }
    public function show($id)
    {
        return $this->getvendaServico()->find($id);
    }
    public function create($data)
    {
        
        $data['cfc_id'] = auth()->user()->cfc_selecionado;
        return $this->getvendaServico()->create($data);
    }
    public function update($data, $id)
    {
        $data['cfc_id'] = auth()->user()->cfc_selecionado;
        return $this->getvendaServico()->find($id)->update($data);
    }
    public function delete($id)
    {
        return $this->getvendaServico()->find($id)->delete();
    }

}
