<?php

namespace App\Services;

use App\Models\AutoEscola;
use App\Models\Clinica;

class ServiceClinica
{

    /**
     * @var Clinica
     */
    private $clinica;

    public function __construct(Clinica $clinica)
   {
       $this->clinica = $clinica;
   }

    /**
     * @return autoEscola
     */
    public function getClinica()
    {
        return $this->clinica;
    }


    public function clinicaList()
    {
        return $this->getClinica()
            ->pluck('nome','id');
    }

    public function byApi()
    {

        return $this->getClinica()
            ->orderBy('id','desc')
            ->get();
    }

    public function all()
    {
        return $this->getClinica()
            ->where('cfc_id', auth()->user()->cfc_selecionado)
            ->orderBy('id','desc')
            ->paginate();
    }

    public function show($id)
    {
        return $this->getClinica()
        ->find($id);
    }
    public function create($data)
    {
        $data['cfc_id'] = auth()->user()->cfc_selecionado;
        $cfc = $this->getClinica()->create($data);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($cfc)
            ->log("CLINICA: :subject.nome foi criado");

        return $cfc;
    }
    public function update($data, $id)
    {
        $cfc = $this->getClinica()->find($id);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($cfc)
            ->log("CLINICA: :subject.nome foi atualizado");

        return $cfc->update($data);
    }
    public function delete($id)
    {
        $cfc = $this->getClinica()->find($id);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($cfc)
            ->log("CLINICA: :subject.nome foi deletado");

        return $cfc->delete();
    }

    public function search($search)
    {
        return $this->getClinica()
        ->where(function ($query) use ($search) {
            if ($search['nome']) {
                $filter = $search['nome'];
                $query->where(function ($querySub) use ($filter) {
                    $querySub->where('nome', 'LIKE', "%{$filter}%");
                });
            }
            if ($search['cnpj']) {
                $filter = $search['cnpj'];
                $query->where(function ($querySub) use ($filter) {
                    $querySub->where('cnpj', 'LIKE', "%{$filter}%");
                });
            }
        })
        ->select('*')
        ->paginate();
    }
}
