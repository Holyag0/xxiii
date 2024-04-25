<?php

namespace App\Services;

use App\Models\Servicos;
use App\Models\Fornecedor;

class ServiceFornecedor
{

    /**
     * @var fornecedores
     */
    private $fornecedores;
    /**
     *
     */
  //  private $alunos;

    public function __construct(Fornecedor $fornecedores)
   {
       $this->fornecedores = $fornecedores;

   }

    /**
     * @return fornecedores
     */
    public function getFornecedor()
    {
        return $this->fornecedores;
    }

    public function fornecedorList()
    {
        return $this->getFornecedor()
            ->where('cfc_id', auth()->user()->cfc_selecionado)
            ->pluck('nome','id');
    }

    public function all()
    {
      return $this->getFornecedor()
        ->where('cfc_id', auth()->user()->cfc_selecionado)
        ->paginate();
    }
    public function show($id)
    {
        return $this->getFornecedor()->find($id);
    }
    public function create($data)
    {
        $data['cfc_id'] = auth()->user()->cfc_selecionado;
        
        return $this->getFornecedor()->create($data);
    }
    public function update($data, $id)
    {
        $data['cfc_id'] = auth()->user()->cfc_selecionado;
        return $this->getFornecedor()->find($id)->update($data);
    }
    public function delete($id)
    {
        return $this->getFornecedor()->find($id)->delete();
    }

}
