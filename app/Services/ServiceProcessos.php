<?php

namespace App\Services;

use App\Models\Servicos;
use App\Models\Processos;

class ServiceProcessos
{

    // /**
    //  * @var Cantegorias
    //  */
    private $processos;
    /**
     *
     */
  //  private $alunos;

    public function __construct(Processos $processos)
   {
       $this->processos = $processos;

   }
    // /**
    //  *     @return CentroCustos
    //  */
    public function getProcessos()
    {
        return $this->processos;
    }

    public function processosList()
    {
        return $this->getProcessos()
            ->where('cfc_id', auth()->user()->cfc_selecionado)
            ->pluck('categoria','id');
    }

    public function all()
    {
        return $this->getProcessos()
        ->where('cfc_id', auth()->user()->cfc_selecionado)
        ->paginate();
    }
    public function show($id)
    {
        return $this->getProcessos()->find($id);
    }
    public function create($data)
    {
        if (isset($data['status']) && is_array($data['status'])) {
            $data['status'] = array_search(true, $data['status']);
        }
        if (isset($data['categoria']['name'])) {
            $data['categoria'] = $data['categoria']['name'];
        }

        $data['taxas'] = isset($data['taxas']) ? 'Sim' : 'Não';


        $data['cfc_id'] = auth()->user()->cfc_selecionado;
        $data['user_id'] = auth()->user()->id;


        
        return $this->getProcessos()->create($data);
    }
    public function update($data, $id)
    {
        $data['cfc_id'] = auth()->user()->cfc_selecionado;
        return $this->getProcessos()->find($id)->update($data);
    }
    public function delete($id)
    {
        return $this->getProcessos()->find($id)->delete();
    }

}
