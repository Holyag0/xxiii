<?php

namespace App\Services;

use App\Http\Resources\PacoteResource;
use App\Models\Pacote;

class ServicePacote
{
    private $pacote;

    public function __construct(Pacote $pacote)
   {
       $this->pacote = $pacote;
   }

    public function getPacote()
    {
        return $this->pacote;
    }


    public function pacoteList()
    {
        return $this->getPacote()
            ->where('cfc_id',auth()->user()->cfc_selecionado)
            ->where('status','1')
            ->pluck('nome','id');
    }
   
    public function getPacotesByCategoria($categoria)
    {
        return $this->getPacote()->with('servicos')
        ->where('cfc_id',auth()->user()->cfc_selecionado)
        ->where('categoria', $categoria) ->paginate();
    }

   


    public function all()
    {
        return $this->getPacote()
            ->with('servicos')
            ->where('cfc_id',auth()->user()->cfc_selecionado)
            ->orderBy('id','desc')
            ->paginate();
    }
    public function show($id)
    {
        return $this->getPacote()->with('servicos')->find($id);
    }
    public function create($data)
    {
        $data['cfc_id'] = auth()->user()->cfc_selecionado;
        $pacote = $this->getPacote()->create($data);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($pacote)
            ->log("PACOTE: :subject.nome foi criado");

        $pacote->servicos()->attach($data['servicos']);

        return $pacote;
    }
    public function update($data, $id)
    {
        $data['cfc_id'] = auth()->user()->cfc_selecionado;
        $this->getPacote()->find($id)->update($data);

        $pacote = $this->getPacote()->find($id);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($pacote)
            ->log("PACOTE: :subject.nome foi alterado");

        $pacote->servicos()->sync($data['servicos']);

        return $pacote;
    }
    public function delete($id)
    {
        $pacote = $this->getPacote()->find($id);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($pacote)
            ->log("PACOTE: :subject.nome foi deletado");

        $pacote->delete();
    }
}
