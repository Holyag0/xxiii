<?php

namespace App\Services;

use App\Models\Servicos;
use App\Models\CentroCustos;

class ServiceCentroCustos
{

    /**
     * @var CentroCustos
     */
    private $centroCustos;
    /**
     *
     */
  //  private $alunos;

    public function __construct(CentroCustos $centroCustos)
   {
       $this->centroCustos = $centroCustos;

   }

    /**
     * @return CentroCustos
     */
    public function getCentroCustos()
    {
        return $this->centroCustos;
    }

    public function centroCustoList()
    {
        return $this->getCentroCustos()
            ->where('cfc_id', auth()->user()->cfc_selecionado)
            ->pluck('name','id');
    }

    public function all()
    {
        return $this->getCentroCustos()
            ->where('cfc_id', auth()->user()->cfc_selecionado)->paginate();
    }
    public function find($id)
    {
        return $this->getCentroCustos()->find($id);
    }
    public function create($data)
    {
        $data['cfc_id'] = auth()->user()->cfc_selecionado;

        return $this->getCentroCustos()->create($data);
    }
    public function update($data, $id)
    {
        $data['cfc_id'] = auth()->user()->cfc_selecionado;
        return $this->getCentroCustos()->find($id)->update($data);
    }
    public function delete($id)
    {
        return $this->getCentroCustos()->find($id)->delete();
    }

}
