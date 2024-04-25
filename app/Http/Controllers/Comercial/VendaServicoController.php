<?php

namespace App\Http\Controllers\Comercial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ServiceVenda_servico;

class VendaServicoController extends Controller
{
    private $vendaServico;

    public function __construct(ServiceVenda_servico $vendaServico)
    {
      $this->vendaServico =  $vendaServico;
    }

    public function getvendaServico(){
        return $this->vendaServico;
    }

    public function index(){
        
        $vendaServico = $this->getvendaServico()->all();

        return Inertia::render('Cadastros/vendaServico/index',[
            'vendaServico' => $vendaServico
        ]);
    }

    public function create()
    {   
        $clinicas = $this->getClinicas()-> clinicaList();
        return Inertia::render('Cadastros/vendaServico/create',['clinicas'=>$clinicas]);
    }

    public function show($id){
        $vendaServico = $this->getvendaServico()->show($id);

        return Inertia::render('Cadastros/vendaServico/show',[
            'vendaServico' => $vendaServico
        ]);
    }

    public function store(Request $request){
        
        $vendaServico = $this->getvendaServico()->create($request->all());

        if ($vendaServico){
            return redirect()->route('atendimentos')->with('success', 'vendaServico Aberto com Sucesso!');
        }

        return redirect()->route('profissional.index')->errors()->all();

    }

    public function edit($id){
        $vendaServico = $this->getvendaServico()->show($id);

        return Inertia::render('Cadastros/vendaServico/edit',[
            'vendaServico' => $vendaServico
        ]);
    }


    public function update(Request $request, $id){

        $vendaServico = $this->getvendaServico()->update($request->all(),$id);

        if ($vendaServico)
        {
            return redirect()->route('profissional.index')
                ->with('success', 'vendaServico Alterada com Sucesso!');
        }

        return redirect()->route('profissional.index')->errors()->all();
    }
}
