<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Models\Colaborador;
use Illuminate\Support\Facades\Auth;
use DB;

class ServiceColaborador
{

    /**
     * @var Colaborador
     */
    private $colaborador;

    public function __construct(Colaborador $colaborador)
   {
       $this->colaborador = $colaborador;
   }

    /**
     * @return Colaborador
     */
    public function getColaborador()
    {
        return $this->colaborador;
    }

    public function colaboradoresList()
    {
        return $this->getColaborador()
        ->where('cfc_id',auth()->user()->cfc_selecionado)
        ->pluck('nome','id');
    }

    public function all()
    {
        return $this->getColaborador()
        ->where('cfc_id', auth()->user()->cfc_selecionado)
        ->orderBy('id','desc')
        ->paginate();
    }
    public function show($id)
    {
        return $this->getColaborador()->find($id);
    }
    public function create($data)
    {
        $data['cfc_id'] = auth()->user()->cfc_selecionado;
        $colaborador = $this->getColaborador()->create($data);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($colaborador)
            ->log("COLABORADOR: :subject.nome foi criado, CPF :subject.cpf");
    
        return $colaborador;
    }
    public function update($data, $id)
    {
        $data['cfc_id'] = auth()->user()->cfc_selecionado;
        
        $colaborador = $this->getColaborador()->find($id);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($colaborador)
            ->log("COLABORADOR: :subject.nome foi alterado, CPF :subject.cpf");

        return $colaborador->update($data);
    }
    public function delete($id)
    {
        $colaborador = $this->getColaborador()->find($id);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($colaborador)
            ->log("COLABORADOR: :subject.nome foi deletado, CPF :subject.cpf");

        return $colaborador->delete();
    }
}