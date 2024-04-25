<?php

namespace App\Http\Controllers\Financeiro;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContaRequest;
use App\Http\Requests\ContaUpdateRequest;
use App\Http\Requests\DefaultRequest;
use App\Services\ServiceClinica;
use App\Services\ServiceContasDigitais;
use Inertia\Inertia;

class ContasDigitaisController extends Controller
{

    private $contas;
    private $clinicas;

    public function __construct(ServiceContasDigitais $contas, ServiceClinica $clinicas)
    {
        $this->middleware('permission:contas-list|contas-create|contas-edit|contas-delete', ['only' => 'index']);
        $this->middleware('permission:contas-create', ['only' => ['create','store']]);
        $this->middleware('permission:contas-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:contas-delete', ['only' => ['destroy']]);
        $this->contas = $contas;
        $this->clinicas = $clinicas;
    }

    public function getContas()
    {
        return $this->contas;
    }

    public function getClinicas()
    {
        return $this->clinicas;
    }

    public function index()
    {
        $contas = $this->getContas()->all();

        return Inertia::render('MenuContas/ContasDigitais/index',[
            'contas' => $contas
        ]);
    }

    public function show($id)
    {
        $conta = $this->getContas()->show($id);

        return Inertia::render('MenuContas/ContasDigitais/show',[
            'conta' => $conta
        ]);
    }

    public function create()
    {
        return Inertia::render('MenuContas/ContasDigitais/create');
    }

    public function store(ContaRequest $request)
    {
        $conta = $this->getContas()->create($request->all());

        if ($conta)
        {
            return redirect()->route('contas.index')->with('success', 'Conta Digital Cadastrada com Sucesso!');
        }

        return redirect()->route('contas.index')->errors()->all();
    }

    public function edit($id)
    {
        $conta = $this->getContas()->show($id);

        return Inertia::render('MenuContas/ContasDigitais/edit',[
            'conta' => $conta
        ]);
    }

    public function update(ContaUpdateRequest $request, $id)
    {
        $conta = $this->getContas()->update($request->all(),$id);

        if ($conta)
        {
            return redirect()->route('contas.index')->with('success', 'Conta Digital Alterada com Sucesso!');
        }

        return redirect()->route('contas.index')->errors()->all();
    }

    public function search(DefaultRequest $request)
    {
        $data = $request->all();

        $filters = $request->except('_token');

        $contas = $this->getContas()->search($data);
        $clinicas = $this->getClinicas()->clinicaList();

        return view('ntc.financeiro.contas.index',compact('contas','filters','clinicas'));
    }


}
