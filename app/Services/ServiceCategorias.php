<?php

namespace App\Services;

use App\Models\Servicos;
use App\Models\Categoria;

class ServiceCategorias
{

    /**
     * @var Cantegorias
     */
    private $categorias;
    /**
     *
     */
  //  private $alunos;

    public function __construct(Categoria $categorias)
   {
       $this->categorias = $categorias;

   }

    /**
     * @return CentroCustos
     */
    public function getCategorias()
    {
        return $this->categorias;
    }

    public function categoriaList()
    {
        return $this->getCategorias()
            ->where('cfc_id', auth()->user()->cfc_selecionado)
            ->pluck('name','id');
    }

    public function all()
    {
        return $this->getCategorias()
        ->where('cfc_id', auth()->user()->cfc_selecionado)
        ->paginate();
    }
    public function show($id)
    {
        return $this->getCategorias()->find($id);
    }
    public function create($data)
    {
        $data['cfc_id'] = auth()->user()->cfc_selecionado;
        return $this->getCategorias()->create($data);
    }
    public function update($data, $id)
    {
        $data['cfc_id'] = auth()->user()->cfc_selecionado;
        return $this->getCategorias()->find($id)->update($data);
    }
    public function delete($id)
    {
        return $this->getCategorias()->find($id)->delete();
    }

}
