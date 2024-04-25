<?php

namespace App\Http\Controllers\Comercial;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServicosRequest;
use App\Services\ServiceClinica;
use App\Services\ServiceServicos;
use Inertia\Inertia;

class ServicosController extends Controller
{
    /**
     * @var ServiceServicos
     */
    private $servicos;
    /**
     * @var ServiceClinica
     */
    private $clinica;

    public function __construct(ServiceServicos $servicos, ServiceClinica $clinica)
    {
        $this->middleware('permission:servico-list|servico-create|servico-edit|servico-delete', ['only' => 'index']);
        $this->middleware('permission:servico-create', ['only' => ['create','store']]);
        $this->middleware('permission:servico-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:servico-delete', ['only' => ['destroy']]);
        $this->servicos = $servicos;
        $this->clinica = $clinica;
    }

    /**
     * @return ServiceServicos
     */
    public function getServicos()
    {
        return $this->servicos;
    }

    /**
     * @return ServiceClinica
     */
    public function getClinica()
    {
        return $this->clinica;
    }

    public function index()
    {
        $servicos = $this->getServicos()->all();

        return Inertia::render('Comercial/Servicos/index',[
            'servicos' => $servicos
        ]);
    }

    public function create()
    {
        return Inertia('Comercial/Servicos/create');
    }

    public function store(ServicosRequest $request)
    {
        $servicos = $this->getServicos()->create($request->all());

        if ($servicos)
        {
            return redirect()->route('servico.index')
                ->with('success','Serviço Cadastrada com Sucesso.');
        }

        return redirect()->route('servico.index')->errors()->all();
    }

    public function show($id)
    {
        $servico = $this->getServicos()->show($id);

        return Inertia::render('Comercial/Servicos/show',[
            'servico' => $servico
        ]);
    }

    public function edit($id)
    {
        $servico = $this->getServicos()->show($id);

        return Inertia::render('Comercial/Servicos/edit',[
            'servico' => $servico
        ]);

    }

    public function update(ServicosRequest $request, $id)
    {
        $servico = $this->getServicos()->update($request->all(),$id);

        if ($servico)
        {
            return redirect()->route('servico.index')
                ->with('success', 'Serviço Alterado com Sucesso!');
        }

        return redirect()->route('servico.index')->errors()->all();
    }

    public function destroy($id)
    {
        $servico = $this->getServicos()->delete($id);

        if ($servico)
        {
            return redirect()->route('servico.index')
                ->with('success', 'Servico Deletado com Sucesso!');
        }

        return redirect()->route('servico.index')->errors()->all();

    }

}
