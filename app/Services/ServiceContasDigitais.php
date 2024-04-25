<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Models\ContasDigitais;

class ServiceContasDigitais
{

    /**
     * @var contas
     */
    private $contas;

    public function __construct(ContasDigitais $contas)
   {
       $this->contas = $contas;
   }

    /**
     * @return contas
     */
    public function getContas()
    {
        return $this->contas;
    }

    public function contasList()
    {
        return $this->getContas()
            ->where('cfc_id', auth()->user()->cfc_selecionado)
            ->pluck('nome','id');
    }

    public function cfcByCfc($id)
    {
        return $this->getContas()->pluck('cfc_id','id');
    }

    public function all()
    {
        return $this->getContas()
            ->where('cfc_id', auth()->user()->cfc_selecionado)
            ->orderBy('id','desc')
            ->paginate();
    }
    public function show($id)
    {
        return $this->getContas()->find($id);
    }
    public function create($data)
    {
        if($data['saldo_inicial'])
            $data['saldo_atual'] = $data['saldo_inicial'];

        $data['cfc_id'] = auth()->user()->cfc_selecionado;

        $conta = $this->getContas()->create($data);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($conta)
            ->log("CONTA: :subject.nome foi criada");

        return $conta;
    }
    public function update($data, $id)
    {
        $conta = $this->getContas()->find($id);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($conta)
            ->log("CONTA: :subject.nome foi alterada");

        $data['cfc_id'] = auth()->user()->cfc_selecionado;

        return $conta->update($data);
    }
    public function search($request)
    {
        return $this->getContas()
        ->where(function ($query) use ($request) {
            if ($request['nome']) {
                $filter = $request['nome'];
                $query->where(function ($querySub) use ($filter) {
                    $querySub->where('nome', 'LIKE', "%{$filter}%");
                });
            }

            if (isset($request['cfc_id'])) {
                $query->where('cfc_id', $request['cfc_id']);
            }
        })
        ->orderBy('id','desc')
        ->paginate();
    }
}
