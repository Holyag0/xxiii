<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Models\Cfc;


class ServiceCfc
{

    /**
     * @var clinica
     */
    private $cfc;

    public function __construct(Cfc $cfc)
   {
       $this->cfc = $cfc;
   }

    /**
     * @return cfc
     */
    public function getCfc()
    {
        return $this->cfc;
    }

    public function cfcList()
    {
        return $this->getCfc()->pluck('nome','id');
    }

    public function all()
    {
        return $this->getCfc()->orderBy('id','desc')->paginate();
    }
    public function show($id)
    {
        return $this->getCfc()->find($id);
    }
    public function create($data)
    {
        $clinica = $this->getCfc()->create($data);
        
        activity()
            ->causedBy(auth()->user())
            ->performedOn($clinica)
            ->log("AUTO ESCOLA: :subject.nome foi criado");

        return $clinica;
    }
    public function update($data, $id)
    {
        $clinica = $this->getCfc()->find($id);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($clinica)
            ->log("AUTO ESCOLA: :subject.nome foi alterado");

        return $clinica->update($data);
    }
    public function delete($id)
    {
        $clinica = $this->getCfc()->find($id);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($clinica)
            ->log("AUTO ESCOLA: :subject.nome foi deletado");

        return $clinica->delete();
    }

    public function search($request)
    {
        return $this->getCfc()
        ->where(function ($query) use ($request) {
                $filter = $request['nome'];
                $query->where(function ($querySub) use ($filter) {
                    $querySub->where('nome', 'LIKE', "%{$filter}%");
                });     
        })
        ->orderBy('id','desc')
        ->paginate();
    }
}