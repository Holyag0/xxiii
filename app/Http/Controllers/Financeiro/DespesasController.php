<?php

namespace App\Http\Controllers\Financeiro;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaixarDespesasRequest;
use App\Http\Requests\DefaultRequest;
use App\Http\Requests\DespesaRequest;
use App\Services\ServiceCentroCustos;
use App\Services\ServiceClinica;
use App\Services\ServiceContas;
use App\Services\ServiceContasDigitais;
use App\Services\ServiceDespesas;
use App\Services\ServiceFornecedor;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DespesasController extends Controller
{
    protected $serviceDespesas;
    protected $clinicas;
    protected $fornecedores;
    protected $centroCustos;
    protected $contas;
    private $PDF;

    public function __construct(
        ServiceDespesas $serviceDespesas,
        ServiceClinica $clinicas,
        ServiceFornecedor $fornecedores,
        ServiceCentroCustos $centroCustos,
        ServiceContasDigitais $contas,
        PDF $PDF)
    {
        $this->middleware('permission:despesa-list|despesa-create|despesa-edit|despesa-delete', ['only' => 'index']);
        $this->middleware('permission:despesa-create', ['only' => ['create','store']]);
        $this->middleware('permission:despesa-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:despesa-delete', ['only' => ['destroy']]);
        $this->serviceDespesas = $serviceDespesas;
        $this->clinicas = $clinicas;
        $this->fornecedores = $fornecedores;
        $this->centroCustos = $centroCustos;
        $this->contas = $contas;
        $this->PDF = $PDF;
    }

    public function getDespesas()
    {
        return $this->serviceDespesas;
    }
    public function getClinicas()
    {
        return $this->clinicas;
    }
    public function getFornecedores()
    {
        return $this->fornecedores;
    }
    public function getCentroCustos()
    {
        return $this->centroCustos;
    }
    public function getContas()
    {
        return $this->contas;
    }

    public function getPDF()
    {
        return $this->PDF;
    }

    public function index(Request $request)
    {   
        $search = $request->get('search');

        if ($search) {
            $despesas = $this->getDespesas()->search($search);
            // dd($despesas);
        }else{
            $despesas = $this->getDespesas()->all();
          
        }
       
        $despesas = $this->getDespesas()-> all();
        // dd($despesas);
        $centroCustos = $this->getCentroCustos()->centroCustoList();
      
        return Inertia::render('Financeiro/Despesas/index',[
            'despesas' => $despesas,
            'centroCustos' => $centroCustos
        ]);
    }
    public function despesaVencimento(Request $request)
    {   
        $search = $request->get('search');

        if ($search) {
            $despesas = $this->getDespesas()->search($search);
        }else{
            $despesas = $this->getDespesas()->all();
          
        }
       
        $despesas = $this->getDespesas()-> notificationPainel();
        $centroCustos = $this->getCentroCustos()->centroCustoList();
      
        return Inertia::render('Financeiro/Despesas/despesasVencimento',[
            'despesas' => $despesas,
            'centroCustos' => $centroCustos
        ]);
    }

    public function create()
    {      
        $centroCustos = $this->getCentroCustos()->centroCustoList();
        $fornecedores = $this->getFornecedores()->fornecedorList();

        return Inertia::render('Financeiro/Despesas/create', [
            'centroCustos' => $centroCustos,
            'fornecedores' => $fornecedores
        ]);
    }

    public function store(DespesaRequest $request)
    {
        $despesa = $this->getDespesas()->create($request->all());

        if ($despesa)
        {
            return redirect()->route('despesas.index')->with('success', 'Despesa Cadastrada com Sucesso!');
        }

        return redirect()->route('despesas.index')->errors()->all();

    }

    public function show($id){
        $despesa = $this->getDespesas()->find($id);

        return Inertia::render('Financeiro/Despesas/show', [
            'despesa' => $despesa
        ]);
    }

    public function edit($id){
        $despesa = $this->getDespesas()->find($id);
        
        $centroCustos = $this->getCentroCustos()->centroCustoList();
        $fornecedores = $this->getFornecedores()->fornecedorList();

        return Inertia::render('Financeiro/Despesas/edit', [
            'despesa' => $despesa,
            'centroCustos' => $centroCustos,
            'fornecedores' => $fornecedores
        ]);
    }


    public function update(DespesaRequest $request, $id)
    {
        $despesa = $this->getDespesas()->update($request->all(),$id);

        if ($despesa)
        {
            return redirect()->route('despesas.index')->with('success', 'Despesa Alterada com Sucesso!');
        }

        return redirect()->route('despesas.index')->errors()->all();
    }

    public function baixar($id){
        $despesa = $this->getDespesas()->find($id);
        $contas = $this->getContas()->contasList();

        return Inertia::render('Financeiro/Despesas/baixar',[
            'despesa' => $despesa,
            'contas' => $contas
        ]);
    }

    public function efetuarBaixa(BaixarDespesasRequest $request)
    {
        $despesa = $this->getDespesas()->baixar($request->all());

        if ($despesa)
        {
            return redirect()->route('despesas.index')->with('success', 'Baixa Efetuada com Sucesso!');
        }

        return redirect()->route('despesas.index')->errors()->all();
    }

    public function reabrir($id)
    {
        $despesa = $this->getDespesas()->reabrir($id);

        if ($despesa)
        {
            return redirect()->route('despesas.index')->with('success', 'Despesa foi Reaberta com Sucesso!');
        }

        return redirect()->route('despesas.index')->errors()->all();
    }

    public function search(DefaultRequest $request)
    {   
        $search = $request->get('search');  

        $filters = $request->except('_token');

        $despesas = $this->getDespesas()->search($search);
        $clinicas = $this->getClinicas()->clinicaList();
        $centroCustos = $this->getCentroCustos()->centroCustoList();
        $fornecedores = $this->getFornecedores()->fornecedorList();

        return view('ntc.financeiro.despesas.index',compact('despesas','filters','clinicas','fornecedores','centroCustos'));

    }

    public function destroy($id)
    {
        $despesa = $this->getDespesas()->delete($id);

        if ($despesa)
        {
            return redirect()->route('despesas.index')->with('success', 'Despesa foi Deletada com Sucesso!');
        }

        return redirect()->route('despesas.index')->errors()->all();

    }

    public function relatoriosDespesas(DefaultRequest $request)
    {
        
        $data = $request->all();
            
        if (isset($data['data_inicio']) == ""){
            $data['data_inicio'] = date("Y")."-".date("m")."-01";
        }

        if (isset($data['data_fim']) == ""){
            $data['data_fim'] = date("Y")."-".date("m")."-31";
        }

        $despesa = $this->getDespesas()->relatorio($data);
        

        $this->getPDF()->setPaper('A4', 'portrait');
        $this->getPDF()->setOptions(
            [
                'defaultMediaType'=> 'all',
                'isFontSubsettingEnabled' => true,
                'isPhpEnabled' => true
            ]);

        return $this->getPDF()->loadView('relatorios.relatorio_despesas', compact('despesa'))
        ->stream("relatorio_despesas.pdf");
    }

    public function gerearRelatorioDespesas(){

        $centroCustos = $this->getCentroCustos()->all();
        return view('relatorios.form_relatorio.form_relatorio_despesa', compact('centroCustos'));
    }
  
}
