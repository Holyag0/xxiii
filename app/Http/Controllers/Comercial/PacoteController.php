<?php

namespace App\Http\Controllers\Comercial;

use App\Http\Controllers\Controller;

use App\Http\Requests\PacoteRequest;
use App\Http\Requests\DefaultRequest;
use App\Http\Resources\PacoteResource;
use App\Models\Pacote;
use App\Services\ServiceClinica;
use App\Services\ServicePacote;
use App\Services\ServiceServicos;
use App\Services\ServiceProcessos;
use Inertia\Inertia;

class PacoteController extends Controller
{
     /**
     * @var ServiceProcessos
     */
    private $processo;
     /**
     * @var ServicePacote
     */
    private $pacote;

     /**
     * @var ServiceClinica
     */
    private $clinicas;

     /**
     * @var ServiceServicos
     */
    private $servicos;
    
        public function __construct(ServiceProcessos $processos, ServicePacote $pacote, ServiceClinica $clinicas, ServiceServicos $servicos)
       {
            $this->middleware('permission:pacote-list|pacote-create|pacote-edit|pacote-delete', ['only' => 'index']);
            $this->middleware('permission:pacote-create', ['only' => ['create','store']]);
            $this->middleware('permission:pacote-edit', ['only' => ['edit','update']]);
            $this->middleware('permission:pacote-delete', ['only' => ['destroy']]);
            $this->pacote = $pacote;
            $this->clinicas = $clinicas;
            $this->servicos = $servicos;
            $this->processo = $processos;
       }

        /**
     * @return ServiceProcessos
     */
    public function getProcessos()
    {
        return $this->processo;
    }

    
    /**
     * @return ServicePacote
     */
    public function getPacote()
    {
        return $this->pacote;
    }

     /**
     * @return ServiceClinica
     */
    public function getClinicas()
    {
        return $this->clinicas;
    }

     /**
     * @return ServiceServicos
     */
    public function getServicos()
    {
        return $this->servicos;
    }
            
    public function index()
    {
        $pacotes = $this->getPacote()->all();

        return Inertia::render('Comercial/Pacotes/index',[
            'pacotes' => $pacotes
        ]);
    }

    public function create()
    {
        $servicos = $this->getServicos()->servicoList();
        $processos = $this->getProcessos()->processosList();

        return Inertia::render('Comercial/Pacotes/create',[
            'servicos' => $servicos,
            'processsos' => $processos
        ]);
    }


    public function store(PacoteRequest $request)
    {        
        $pacote = $this->getPacote()->create($request->all());

        if ($pacote)
        {
            return redirect()->route('pacote.index')
                ->with('success','Pacote Cadastrado com Sucesso.');
        }

        return redirect()->route('pacote.index')->errors()->all();
    }

    public function show($id)
    {
        $pacote = $this->getPacote()->show($id);

        return Inertia::render('Comercial/Pacotes/show',[
            'pacote' => $pacote,
        ]);
    }

    public function edit($id)
    {
        $pacote = new PacoteResource($this->getPacote()->show($id));
        $servicos = $this->getServicos()->servicoList();

        return Inertia::render('Comercial/Pacotes/edit',[
            'pacote' => $pacote,
            'servicos' => $servicos
        ]);

    }

    public function update(PacoteRequest $request, $id)
    {
        $pacote = $this->getPacote()->update($request->all(),$id);

        if ($pacote)
        {
            return redirect()->route('pacote.index')
                ->with('success','Pacote Alterado com Sucesso.');
        }

        return redirect()->route('pacote.index')->errors()->all();
    }

    public function destroy($id)
    {
        $pacote = $this->getPacote()->delete($id);

        if ($pacote)
        {
            return redirect()->route('pacote.index')
                ->with('success','Pacote Deletado com Sucesso.');
        }

        return redirect()->route('pacote.index')->errors()->all();

    }

    // public function search(DefaultRequest $request)
    // {
    //     $data = $request->all();

    //     $filters = $request->except('_token');

    //     $pacote = $this->getPacote()->search($data);

    //     $clinicas = $this->getClinicas()->clinicaList();

    //     return view('ntc.cadastros.pacote.index',compact('pacote','filters','clinicas'));

    // }
}
