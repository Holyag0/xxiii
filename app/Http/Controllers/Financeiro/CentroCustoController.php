<?php

namespace App\Http\Controllers\Financeiro;

use App\Http\Controllers\Controller;
use App\Http\Requests\CentroCustosRequest;
use App\Services\ServiceCentroCustos;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CentroCustoController extends Controller
{
    private $centroCustos;

    public function __construct(ServiceCentroCustos $centroCustos)
    {
        $this->middleware('permission:centro-list|centro-create|centro-edit|centro-delete', ['only' => 'index']);
        $this->middleware('permission:centro-create', ['only' => ['create','store']]);
        $this->middleware('permission:centro-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:centro-delete', ['only' => ['destroy']]);
        $this->centroCustos = $centroCustos;
    }

    public function getCentroCustos()
    {
        return $this->centroCustos;
    }

    public function index(){
        $centroCustos =  $this->getCentroCustos()->all();

        return Inertia::render('Financeiro/CentroCustos/index',[
            'centroCustos' => $centroCustos
        ]);
    }

    public function create()
    {
        return Inertia::render('Financeiro/CentroCustos/create');
    }

    public function show($id){
        $custo = $this->getCentroCustos()->find($id);

        return Inertia::render('Financeiro/CentroCustos/show',[
            'custo' => $custo
        ]);
    }

    public function store(CentroCustosRequest $request){
        $centroCusto = $this->getCentroCustos()->create($request->all());

        if ($centroCusto)
        {
            return redirect()->route('centro_custos.index')
                ->with('success', 'Centro de Custo Cadastrado com Sucesso!');
        }

        return redirect()->route('centro_custos.index')->errors()->all();

    }

    public function edit($id){
        $custo = $this->getCentroCustos()->find($id);

        return Inertia::render('Financeiro/CentroCustos/edit',[
            'custo' => $custo
        ]);
    }

    public function update(CentroCustosRequest $request, $id){

        $custo = $this->getCentroCustos()->update($request->all(),$id);

        if ($custo)
        {
            return redirect()->route('centro_custos.index')->with('success', 'Centro de Custo Cadastrado com Sucesso!');
        }

        return redirect()->route('centro_custos.index')->errors()->all();
    }
}
