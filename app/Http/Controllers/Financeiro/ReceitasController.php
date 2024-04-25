<?php

namespace App\Http\Controllers\Financeiro;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaixarReceitasRequest;
use App\Http\Requests\DefaultRequest;
use App\Http\Requests\ReceitasRequest;
use App\Services\ServiceAluno;
use App\Services\ServiceCategorias;
use App\Services\ServiceCfc;
use App\Services\ServiceClinica;
use App\Services\ServiceContasDigitais;
use App\Services\ServiceReceitas;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Barryvdh\DomPDF\PDF;

class ReceitasController extends Controller
{
    private $serviceReceitas;
    private $clinica;
    private $serviceCategorias;
    private $serviceAluno;
    private $serviceContas;
    /**
     * @var PDF
     */
    private $PDF;
    private $cfc;

    public function __construct(
        ServiceReceitas $serviceReceitas,
        ServiceClinica $clinica,
        ServiceCategorias $serviceCategorias,
        ServiceAluno $serviceAluno,
        ServiceContasDigitais $serviceContas,
        PDF $PDF,
        ServiceCfc $cfc
        )

    {
        $this->middleware('permission:receita-list|receita-create|receita-edit|receita-delete', ['only' => 'index']);
        $this->middleware('permission:receita-create', ['only' => ['create','store']]);
        $this->middleware('permission:receita-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:receita-delete', ['only' => ['destroy']]);

        $this->serviceReceitas = $serviceReceitas;
        $this->clinica = $clinica;
        $this->serviceCategorias = $serviceCategorias;
        $this->serviceAluno = $serviceAluno;
        $this->serviceContas = $serviceContas;
        $this->PDF = $PDF;
        $this->cfc = $cfc;
    }
   /**
     * @return PDF
     */
    public function getPDF()
    {
        return $this->PDF;
    }


    public function getServiceReceitas()
    {
        return $this->serviceReceitas;
    }

    public function getServiceClinica()
    {
        return $this->clinica;
    }

    public function getServiceCategorias()
    {
        return $this->serviceCategorias;
    }

    public function getServiceAluno()
    {
        return $this->serviceAluno;
    }

    public function getServiceContas()
    {
        return $this->serviceContas;
    }

    public function getServiceCfc()
    {
        return $this->cfc;
    }

    public function index(Request $request){
        $search = $request->get('search');

        if ($search) {
            $receitas = $this->getServiceReceitas()->search($search);
        }else{
            $receitas = $this->getServiceReceitas()->all();
        }

        $categorias = $this->getServiceCategorias()->categoriaList();
        $autoEscolas = $this->getServiceCfc()->cfcList();

        return Inertia::render('Financeiro/Receitas/index',[
            'receitas' => $receitas,
            'categorias' => $categorias,
            'autoEscolas' => $autoEscolas
        ]);
    }
    public function multiplaBaixa(DefaultRequest $request){

        $receitas = $request->input('receitas');
        
        $contas = $this->getServiceContas()->contasList();

        $receitaTotal = $this->getServiceReceitas()->somatorioReceitas($receitas);
    
        return Inertia::render('Financeiro/Receitas/baixaMultipla',[
            'receitas'=> $receitas,
            'contas'=> $contas,
            'receitaTotal' => $receitaTotal
        ]);
        
    }

    public function create()
    {
        $categorias = $this->getServiceCategorias()->categoriaList();
        $alunos = $this->getServiceAluno()->alunoList();

        return Inertia::render('Financeiro/Receitas/create',[
            'categorias' => $categorias,
            'alunos' => $alunos
        ]);
    }

    public function show($id){
        $receita = $this->getServiceReceitas()->show($id);

        return Inertia::render('Financeiro/Receitas/show',[
            'receita' => $receita
        ]);
    }

    public function edit($id){
        $receita = $this->getServiceReceitas()->show($id);

        $categorias = $this->getServiceCategorias()->categoriaList();
        $alunos = $this->getServiceAluno()->alunoList();

        return Inertia::render('Financeiro/Receitas/edit',[
            'receita' => $receita,
            'categorias' => $categorias,
            'alunos' => $alunos
        ]);
    }

    public function baixar($id){
        $receita = $this->getServiceReceitas()->show($id);
        $contas = $this->getServiceContas()->contasList();

        return Inertia::render('Financeiro/Receitas/baixar', [
            'receita' => $receita,
            'contas' => $contas
        ]);
    }

    public function efetuarBaixa(BaixarReceitasRequest $request)
    {
        $receita = $this->getServiceReceitas()->baixar($request->all());

        if ($receita)
        {
            return redirect()->route('receitas.index')->with('success', 'Baixa Efetuada com Sucesso!');
        }

        return redirect()->route('receitas.index')->errors()->all();
    }

    public function reabrir($id)
    {
        $receita = $this->getServiceReceitas()->reabrir($id);

        if ($receita)
        {
            return redirect()->route('receitas.index')->with('success', 'Receita Reaberta com Sucesso!');
        }

        return redirect()->route('receber.index')->errors()->all();
    }

    public function store(ReceitasRequest $request)
    {
        $receita = $this->getServiceReceitas()->create($request->all());

        if ($receita)
        {
            return redirect()->route('receitas.index')->with('success', 'Receita Cadastrada com Sucesso!');
        }

        return redirect()->route('receitas.index')->errors()->all();

    }


    public function update(ReceitasRequest $request, $id)
    {
        $receita = $this->getServiceReceitas()->update($request->all(),$id);

        if ($receita)
        {
            return redirect()->route('receitas.index')->with('sucess', 'Receita Alterada com Sucesso!');
        }

        return redirect()->route('receitas.index')->errors()->all();
    }

    public function search(DefaultRequest $request)
    {
        $data = $request->all();

        $filters = $request->except('_token');

        $contasReceber = $this->getServiceReceitas()->search($data);
        $clinicas = $this->getServiceClinica()->clinicaList();
        $categorias = $this->getServiceCategorias()->categoriaList();
        $alunos = $this->getServiceAluno()->alunoList();

        return view('ntc.financeiro.contas_receber.index',compact('contasReceber','filters','clinicas','alunos','categorias'));

    }

    public function destroy($id)
    {
        $receita = $this->getServiceReceitas()->delete($id);

        if ($receita)
        {
            return redirect()->route('receitas.index')->with('success', 'Receita Deletada com Sucesso!');
        }

        return redirect()->route('receitas.index')->errors()->all();

    }
    public function gerearRelatorioReceitas(){

        return view('relatorios.form_relatorio.form');
    }
    public function relatorios(DefaultRequest $request){
    $data = $request->all();


    if (isset($data['data_inicio']) == "") {
        $data['data_inicio'] = date("Y")."-".date("m")."-01";
    }

    if (isset($data['data_fim']) == "") {
        $data['data_fim'] = date("Y")."-".date("m")."-31";
    }

    $receitas = $this->getServiceReceitas()->relatorio($data);

    $this->getPDF()->setPaper('A4', 'portrait');
    $this->getPDF()->setOptions(
        [
            'defaultMediaType'=> 'all',
            'isFontSubsettingEnabled' => true,
            'isPhpEnabled' => true
        ]
    );

    return $this->getPDF()->loadView('Relatorio/receita', compact('receitas', 'data'))
        ->download("receita.pdf");
    }
}

