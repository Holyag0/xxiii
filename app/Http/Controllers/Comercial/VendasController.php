<?php

namespace App\Http\Controllers\Comercial;

use Inertia\Inertia;
use App\Services\ServiceAluno;
use App\Services\ServiceVendas;
use App\Services\ServiceParcelas;
use App\Http\Controllers\Controller;
use App\Http\Requests\VendasRequest;
use App\Http\Requests\DefaultRequest;
use App\Services\ServiceContasDigitais;

class VendasController extends Controller
{
    private $aluno;
    private $vendas;
    private $serviceContas;

    public function __construct(ServiceParcelas $serviceParcelas,ServiceContasDigitais $serviceContas,ServiceVendas $vendas,ServiceAluno $alunos)
    {
        $this->middleware('permission:vendas-list|vendas-create|vendas-edit|vendas-delete', ['only' => 'index']);
        $this->middleware('permission:vendas-create', ['only' => ['create','store']]);
        $this->middleware('permission:vendas-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:vendas-delete', ['only' => ['destroy']]);
        $this->middleware('permission:vendas-baixa-parcela', ['only' => ['baixarParcela']]);
        $this->middleware('permission:vendas-reabre-parcela', ['only' => ['reabrirParcela']]);
        $this->aluno = $alunos;
        $this->vendas = $vendas;
        $this->serviceContas =  $serviceContas;
        $this->serviceParcelas = $serviceParcelas;

    }
    
    public function getVendas(){
        return $this->vendas;
    }
    
    public  function getServiceContas(){
        return $this->serviceContas;
    }

    public function getAluno(){
        return $this->aluno;
    }

    public function getServiceParcelas(){

        return $this->serviceParcelas;
    }

    public function index(){
        $alunos = $this->getAluno()->all();
        $vendas = $this->getVendas()->all();

        return Inertia::render('Financeiro/Categorias/venda',['alunos' => $alunos,
            'vendas' => $vendas
        ]);
    }

    public function store(VendasRequest $request){
        $data = $request->all();
        
        $venda = $this->getVendas()->create($data);

        if ($venda)
            return redirect()->route('aluno.show',$data['aluno_id'])->with('success', 'Venda Efetuada com Sucesso!');

        return redirect()->route('aluno.index')->errors()->all();
    }
  
    public function baixarParcela(VendasRequest $request, $id)
    {
        $data = $request->all();
        $parcela = $this->getServiceParcelas()->baixarParcela($data, $id);

        if ($parcela)
            return redirect()->route('aluno.show',$data['aluno_id'])->with('success', 'Baixa Efetuada com Sucesso!');

        return redirect()->route('aluno.show', $data['aluno_id'])->errors()->all();
       
    }
    public function reabrirParcela(DefaultRequest $request, $id)
    {
        $data = $request->all();

        $parcela = $this->getServiceParcelas()->reabrir($data, $id);
        
        if($parcela){
            return redirect()->route('aluno.show', $data['aluno_id'])->with('success', 'Reabertura de Parcela Efetuada com Sucesso!');
        }
    }
}
