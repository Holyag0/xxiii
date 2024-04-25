<?php

namespace App\Http\Controllers\Exames;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Services\ServiceExameTest;
use App\Http\Controllers\Controller;
use App\Http\Requests\VendasRequest;

class ExamesTestController extends Controller
{
    private $examestest;

    public function __construct(ServiceExameTest $examestest)
    {
        $this->examestest = $examestest;
    }

public function getExameTest()
{
    return $this->examestest;
}
public function show($id){
    $exames = $this->getExames()->show($id);
    $profissional = $this->getProfissionais()->all();
    return Inertia::render('Exames/dadosExame',['exame'=>$exames,'profissional'=>$profissional]);
}

public function update(VendasRequest $request,$id)
{   
    $exames = $this->getExames()->update($request->all(),$id);

    if($exames)
        return redirect()->route('exames.show',$id)->with('success', 'Exame Marcado com Sucesso!');
    
    return redirect()->route('exames.show')->errors()->all();
}
}