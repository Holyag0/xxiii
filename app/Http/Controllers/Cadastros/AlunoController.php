<?php

namespace App\Http\Controllers\Cadastros;

use Inertia\Inertia;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Services\ServiceAluno;
use App\Services\ServiceBoleto;
use App\Services\ServicePacote;
use App\Services\ServiceClinica;
use App\Services\ServiceColaborador;
use App\Services\ServiceContasDigitais;
use App\Services\ServiceVendas;
use App\Services\ServiceServicos;

use App\Http\Controllers\Controller;

use App\Http\Requests\DefaultRequest;
use App\Http\Requests\AlunoRequest;
use App\Services\ServiceCfc;

class AlunoController extends Controller
{
     /**
     * @var ServiceAluno
     */
    private $aluno;
     /**
     * @var ServiceServicos
     */
    private $servico;
    /**
     * @var serviceCfc
     */
    private $serviceCfc;
    /**
     * @var ServicePacote
     */
    private $pacotes;
    /**
     * @var ServiceClinica
     */
    private $clinicas;
    /**
     * @var ServiceColaborador
     */
    private $colaboradores;
    
    /**
     * @var PDF
     */
    private $PDF;

    private $serviceVendas;

    private $serviceContas;

    private $serviceBoleto;

    private $profissionais;

    public function __construct(
        ServiceVendas $serviceVendas,
        ServiceAluno $aluno,
        ServiceCfc $serviceCfc,
        ServicePacote $pacotes,
        ServiceClinica $clinicas,
        ServiceColaborador $colaboradores,
        PDF $PDF,
        ServiceContasDigitais $serviceContas,
        ServiceBoleto $serviceBoleto,
        ServiceServicos $servicos
        
    )
       {
            $this->middleware('permission:aluno-list|aluno-create|aluno-edit|aluno-delete|aluno-relatorio|aluno-dados|aluno-vendas|aluno-exames|aluno-show', ['only' => ['index','show']]);
            $this->middleware('permission:aluno-create', ['only' => ['create','store']]);
            $this->middleware('permission:aluno-edit', ['only' => ['edit','update']]);
            $this->middleware('permission:aluno-delete', ['only' => ['destroy']]);
            $this->aluno = $aluno;
            $this->serviceCfc = $serviceCfc;
            $this->pacotes = $pacotes;
            $this->clinicas = $clinicas;
            $this->colaboradores = $colaboradores;
            $this->PDF = $PDF;
            $this->serviceContas = $serviceContas;
            $this->serviceBoleto = $serviceBoleto;
            $this->serviceVendas = $serviceVendas;
            $this->servico = $servicos;
       }
        /**
     * @return ServicePacote
     */
    public function getPacotes()
    {
        return $this->pacotes;
    }

    /**
     * @return ServiceServicos
     */
    public function getServicos()
    {
        return $this->servico;
    }


    /**
     * @return serviceCfc
     */
    public function getServiceCfc()
    {
        return $this->serviceCfc;
    }

    /**
     * @return ServiceAluno
     */
    public function getAluno()
    {
        return $this->aluno;
    }

    /**
     * @return ServiceClinica
     */
    public function getClinica()
    {
        return $this->clinicas;
    }

     /**
     * @return ServiceColaborador
     */
    public function getColaboradores()
    {
        return $this->colaboradores;
    }

    public function getProfissionais()
    {
        return $this->profissionais;
    }

     /**
     * @return PDF
     */
    public function getPDF()
    {
        return $this->PDF;
    }

    public function getServiceContas()
    {
        return $this->serviceContas;
    }

    public function getServiceBoletos()
    {
        return $this->serviceBoleto;
    }


    public function getServiceVendas(){
        return $this->serviceVendas;
    }


    public function index(Request $request)
    { 
        $search = $request->get('search');

        if ($search) {
            $alunos = $this->getAluno()->search($search);
            $cfcs = $this->getServiceCfc()->cfcList();
            
        }else{
            $alunos = $this->getAluno()->all();
            $cfcs = $this->getServiceCfc()->cfcList();
        }

        return Inertia::render('Atendimentos/ListaClientes',[
            "alunos" => $alunos , 
            'cfcs' => $cfcs  
        ]);
    }

    public function create()
    {
        $pacotes = $this->getPacotes()->pacoteList();
        $cfcs = $this->getServiceCfc()->cfcList();

        return inertia::render('Cadastros/Alunos/create',
        [
            'pacotes' => $pacotes,
            'cfcs' => $cfcs,
        ]);
    }

    public function store(AlunoRequest $request)
    {   
        
        $data = $request->all();

        $aluno = $this->getAluno()->create($data);

        if ($aluno)
            return redirect()->route('aluno.index')->with('success', 'Cliente Cadastrado com Sucesso!');

        return redirect()->route('aluno.index')->errors()->all();
    }

    public function show($id)
    {
        $aluno = $this->getAluno()->show($id);

        $clinicas = $this->getClinica()->clinicaList();

        $colaboradores = $this->getColaboradores()->colaboradoresList();

        $contas = $this->serviceContas->contasList();
      
        $pacotes = $this->getPacotes()->all();
        
        if ($aluno->processos->isEmpty()) {
            // dd($pacotes);
            return Inertia::render('Atendimentos/show',[
                'aluno' => $aluno,
                'clinicas'=> $clinicas,
                'pacotes' => $pacotes,
                'colaboradores' => $colaboradores,
                'contas' => $contas,
            ]);
        }
        else{
            foreach ($aluno->processos as $processo) 
            {   $categoria = $processo->categoria; }

            $pacotes = $this->getPacotes()->getPacotesByCategoria($categoria);
            $servicos = $this->getServicos()->getServicoByProcesso($categoria); 
                    
            return Inertia::render('Atendimentos/show',[
                'aluno' => $aluno,
                'clinicas'=> $clinicas,
                'pacotes' => $pacotes,
                'serv' => $servicos,
                'colaboradores' => $colaboradores,
                'contas' => $contas,
            ]);
        }


       
    }

    public function update(AlunoRequest $request, $id)
    {
        $aluno = $this->getAluno()->update($request->all(),$id);

        if ($aluno)
            return redirect()->route('aluno.show',$id)->with('success', 'Cliente Atualizado com Sucesso!');

        return redirect()->route('aluno.show',$id)->errors()->all();
    }

    public function destroy($id)
    {
        $aluno = $this->getAluno()->delete($id);

        if ($aluno)
        {
            $response = [
                'message' => 'Aluno Deletado com Sucesso.'
            ];
            return redirect()->route('aluno.index')->with('message', $response['message']);
        }

        return redirect()->route('aluno.index')->errors()->all();

    }

    public function search(DefaultRequest $request)
    {
        $search = $request->get('search');

          $alunos = $this->getAluno()->search($search) ; 
        
       
        // $filters = $request->except('_token');

        // $alunos = $this->getAluno()->search($request->all());

         $autoEscola = $this->getServiceCfc()->cfcList();

        // $pacotes = $this->getPacotes()->all();

        // $colaboradores = $this->getColaboradores()->colaboradoresList();

     (Inertia::render('Atendimentos/ListaClientes',[ "alunos" => $alunos ])) ;   
    }

    public function emitirFicha($id)
    {
        $aluno = $this->getAluno()->show($id);

        $this->getPDF()->setPaper('A4', 'portrait');
        $this->getPDF()->setOptions(
            [
                'defaultMediaType'=> 'all',
                'isFontSubsettingEnabled' => true,
                'isPhpEnabled' => true
            ]);

        return $this->getPDF()->loadView('ntc.cadastros.aluno.relatorios.ficha', compact('aluno'))
            ->stream("{$aluno->nome}.pdf");
    }

    public function downloadRecibo($id)
    {
        $aluno = $this->getAluno()->recibo($id);
        
        $datarecibo = Carbon::now()->format('D/M/Y');

        $this->getPDF()->setPaper('A4', 'landscape');
        $this->getPDF()->setOptions(
            [
                'defaultMediaType'=> 'all',
                'isFontSubsettingEnabled' => true,
                'isRemoteEnabled' => true,
                'isPhpEnabled' => true
            ]);
        if(isset($aluno['cfc_id']) == auth()->user()->cfc_selecionado){

            return $this->getPDF()->loadView('relatorios.clientes.recibo', compact('aluno','datarecibo'))
            ->stream("Recibo_do_aluno.pdf");
        }
    }
    public function gerarRelatorioAluno(){
        $autoEscolas = $this->getServiceCfc()->all();
        return view('relatorios.form_relatorio.form_relatorio_aluno', compact('autoEscolas'));
    }
    public function relatorios(DefaultRequest $request){
        $data = $request->all();
            
        if (isset($data['data_inicio'])){
            $data['data_inicio'] = date("Y")."-".date("m")."-01";
        }

        if (isset($data['data_fim'])){
            $data['data_fim'] = date("Y")."-".date("m")."-31";
        }

        $alunos = $this->getAluno()->search($data);
        
        $this->getPDF()->setPaper('A4', 'portrait');
        $this->getPDF()->setOptions(
            [
                'defaultMediaType'=> 'all',
                'isFontSubsettingEnabled' => true,
                'isPhpEnabled' => true
            ]);

        return $this->getPDF()->loadView('relatorios.clientes.relatorio_aluno', compact('alunos' ,'data'))
        ->stream("relatorio.pdf");
    }
}
