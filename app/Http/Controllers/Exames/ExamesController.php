<?php

namespace App\Http\Controllers\Exames;

use Exception;
use Inertia\Inertia;
use App\Services\ServiceExames;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExamesRequest;
use App\Services\ServiceProfissionais;


class ExamesController extends Controller
{
    private $exames;
    private $profissional;

    public function __construct(ServiceExames $exames, ServiceProfissionais $profissional){
        $this->middleware('permission:exame-list', ['only' => ['index, indexUpdate','show']]);
        $this->middleware('permission:exame-lancar', ['only' => ['edit', 'update']]);
        $this->exames =$exames;
        $this->profissional = $profissional;
    }

    public function getExames(){
        return $this->exames;
    }

    public function getProfissionais(){
        return $this->profissional;
    }
    
    public function index(){
        $exames = $this->getExames()->all();

        return Inertia::render('Exames/index',['exames'=>$exames]);
    }

    public function baixaMultipla(ExamesRequest $request){
        
        return Inertia::render('Exames/baixaMultipla',['receitas'=>$request]);
    }

    public function edit($id){
        
        $exames = $this->getExames()->show($id);
        $profissional = $this->getProfissionais()->profissionalList();

        return Inertia::render('Exames/indexLancarExame',['exame'=>$exames,'profissionais'=>$profissional]);
   }

    public function show($id){
        $exames = $this->getExames()->show($id);
        $profissional = $this->getProfissionais()->all();
        return Inertia::render('Exames/dadosExame',['exame'=>$exames,'profissional'=>$profissional]);
    }

    public function update(ExamesRequest $request,$id)
    {   
        $data = $request->all();
 
        $exames = $this->getExames()->update($data,$id);

        if($exames)
            return redirect()->route('aluno.show', $data['aluno_id'])->with('success', 'Exame Atualizado com Sucesso!');
        
        return redirect()->route('exames.show', $data['aluno_id'])->errors()->all();
    }

    public function indexUpdate(ExamesRequest $request,$id)
    {   
        $data = $request->all();
 
        $exames = $this->getExames()->update($data,$id);

        if($exames)
            return redirect()->route('exames.index')->with('success', 'Exame Atualizado com Sucesso!');
        
        return redirect()->route('exames.index')->errors()->all();
    }
    
    
}
