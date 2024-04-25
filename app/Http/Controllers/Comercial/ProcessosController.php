<?php

namespace App\Http\Controllers\Comercial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ServiceProcessos;

class ProcessosController extends Controller
{
    private $processo;

    public function __construct(ServiceProcessos $processos)
    {
      $this->processo =  $processos;
    }

    public function getProcessos(){
        return $this->processo;
    }

    public function index(){
        
        $processos = $this->getProcessos()->all();

        return Inertia::render('Cadastros/processos/index',[
            'processos' => $processos
        ]);
    }

    public function create()
    {   
        $clinicas = $this->getClinicas()-> clinicaList();
        return Inertia::render('Cadastros/processos/create',['clinicas'=>$clinicas]);
    }

    public function show($id){
        $processos = $this->getProcessos()->show($id);

        return Inertia::render('Cadastros/processos/show',[
            'processos' => $processos
        ]);
    }

    public function store(Request $request){
        $data = $request->all();
        
        $processos = $this->getProcessos()->create($data);

        if ($processos){
            return redirect()->route('aluno.show',$data['aluno_id'])->with('success', 'Processo Aberto com Sucesso!');
        }

        return redirect()->route('atendimentos')->errors()->all();

    }

    public function edit($id){
        $profissional = $this->getProcessos()->show($id);

        return Inertia::render('Cadastros/processos/edit',[
            'profissional' => $profissional
        ]);
    }


    public function update(Request $request, $id){

        $processos= $this->getProcessos()->update($request->all(),$id);

        if ($processos)
        {
            return redirect()->route('profissional.index')
                ->with('success', 'processos Alterada com Sucesso!');
        }

        return redirect()->route('profissional.index')->errors()->all();
    }
}
