<?php

namespace App\Services;

use App\Models\Instrutor;

class ServiceInstrutor
{

    /**
     * @var Instrutor
     */
    private $instrutor;

    public function __construct(Instrutor $instrutor)
   {
       $this->instrutor = $instrutor;

   }

    /**
     * @return getInstrutores
     */
    public function getInstrutores()
    {
        return $this->instrutor;
    }

    public function profissionalList()
    {
        return $this->getInstrutores()
            ->where('cfc_id', auth()->user()->cfc_selecionado)
            ->pluck('nome','id');
    }

    public function all()
    {
        return $this->getInstrutores()
        ->where('cfc_id', auth()->user()->cfc_selecionado)
        ->paginate();
    }
    public function show($id)
    {
        return $this->getInstrutores()->find($id);
    }
    public function create($data)
    {
        $data['cfc_id'] = auth()->user()->cfc_selecionado;
        return $this->getInstrutores()->create($data);
    }
    public function update($data, $id)
    {
        return $this->getInstrutores()->find($id)->update($data);
    }
    public function delete($id)
    {
        return $this->getInstrutores()->find($id)->delete();
    }

}
