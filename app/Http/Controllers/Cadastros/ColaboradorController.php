<?php

namespace App\Http\Controllers\Cadastros;

use App\Http\Controllers\Controller;

use App\Http\Requests\ColaboradorRequest;
use App\Http\Requests\ColaboradorUpdateRequest;
use App\Http\Requests\DefaultRequest;

use App\Models\Colaborador;
use App\Services\ServiceClinica;
use App\Services\ServiceColaborador;
use Inertia\Inertia;

class ColaboradorController extends Controller
{
     /**
     * @var ServiceColaborador
     */
    private $colaborador;

     /**
     * @var ServiceClinica
     */
    private $clinicas;
    
        public function __construct(ServiceColaborador $colaborador, ServiceClinica $clinicas)
       {
            $this->middleware('permission:colaborador-list|colaborador-create|colaborador-edit|colaborador-delete', ['only' => 'index']);
            $this->middleware('permission:colaborador-create', ['only' => ['create','store']]);
            $this->middleware('permission:colaborador-edit', ['only' => ['edit','update']]);
            $this->middleware('permission:colaborador-delete', ['only' => ['destroy']]);
            $this->colaborador = $colaborador;
            $this->clinicas = $clinicas;
       }
    
    /**
     * @return ServiceColaborador
     */
    public function getColaborador()
    {
        return $this->colaborador;
    }

     /**
     * @return ServiceClinica
     */
    public function getClinicas()
    {
        return $this->clinicas;
    }
            
    public function index()
    {
        $colaboradores = $this->getColaborador()->all();

        return Inertia::render("Cadastros/Colaboradores/index",[
            'colaboradores' => $colaboradores
        ]);
    }


    public function store(ColaboradorRequest $request)
    {
        $colaborador = $this->getColaborador()->create($request->all());

        if ($colaborador)
        {
            return redirect()->route('colaboradores.index')
                ->with('success','Colaborador Cadastrada com Sucesso.');
        }

        return redirect()->route('colaborador.index')->errors()->all();
    }

    public function create()
    {
        return Inertia::render('Cadastros/Colaboradores/create');
    }

    public function show($id)
    {
        $colaborador = $this->getColaborador()->show($id);

        return Inertia::render('Cadastros/Colaboradores/show',[
            'colaborador' => $colaborador
        ]);
    }

    public function edit($id)
    {
        $colaborador = $this->getColaborador()->show($id);

        return Inertia::render('Cadastros/Colaboradores/edit',[
            'colaborador' => $colaborador
        ]);

    }

    public function update(ColaboradorUpdateRequest $request, $id)
    {
        $colaborador = $this->getColaborador()->update($request->all(),$id);

        if ($colaborador)
        {
            return redirect()->route('colaboradores.index')
                ->with('success','Colaborador Editado com Sucesso.');
        }

        return redirect()->route('colaborador.index')->errors()->all();
    }

    public function destroy($id)
    {
        $colaborador = $this->getColaborador()->delete($id);

        if ($colaborador)
        {
            return redirect()->route('colaboradores.index')
                ->with('success','Colaborador Deletado com Sucesso.');
        }

        return redirect()->route('colaboradores.index')->errors()->all();

    }

    // public function search(DefaultRequest $request)
    // {
    //     $data = $request->all();

    //     $filters = $request->except('_token');

    //     $colaborador = $this->getColaborador()->search($data);

    //     $clinicas = $this->getClinicas()->clinicaList();

    //     return view('ntc.cadastros.colaborador.index',compact('colaborador','filters','clinicas'));

    // }
}
