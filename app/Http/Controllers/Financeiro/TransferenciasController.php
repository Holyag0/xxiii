<?php

namespace App\Http\Controllers\Financeiro;

use Inertia\Inertia;
use App\Http\Requests\ContaRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\DefaultRequest;
use App\Services\ServiceContasDigitais;
use App\Services\ServiceTransferencias;
use App\Http\Requests\ContaUpdateRequest;
use App\Http\Requests\TransferenciaRequest;

class TransferenciasController extends Controller
{

    private $contas;
    private $serviceTransferencias;

    public function __construct(ServiceContasDigitais $contas, ServiceTransferencias $serviceTransferencias)
    {
        $this->middleware('permission:transferencia-list|transferencia-create|transferencia-edit|transferencia-delete', ['only' => 'index']);
        $this->middleware('permission:transferencia-create', ['only' => ['create','store']]);
        $this->middleware('permission:transferencia-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:transferencia-delete', ['only' => ['destroy']]);
        $this->contas = $contas;
        $this->serviceTransferencias = $serviceTransferencias;
    }

    public function getContas()
    {
        return $this->contas;
    }

    public function getTransferencias()
    {
        return $this->serviceTransferencias;
    }

    public function index()
    {
        $transferencias = $this->getTransferencias()->all();

        return Inertia::render('Financeiro/Transferencias/index',[
            'transferencias' => $transferencias
        ]);
    }

    public function create()
    {
        $contas = $this->getContas()->contasList();

        return Inertia::render('Financeiro/Transferencias/create',[
            'contas' => $contas
        ]);
    }

    public function store(TransferenciaRequest $request)
    {
        $transferencia = $this->getTransferencias()->transferir($request->all());

        if ($transferencia)
        {
            return redirect()->route('transferencias.index')->with('success', 'Transferencia Efetuada com Sucesso!');
        }

        return redirect()->route('transferencias.index')->errors()->all();
    }

    public function search(DefaultRequest $request)
    {
        $data = $request->all();

        $filters = $request->except('_token');

        $contas = $this->getContas()->search($data);
        $clinicas = $this->getClinicas()->clinicaList();

        return view('ntc.financeiro.transferencias.index',compact('contas','filters','clinicas'));

    }


}
