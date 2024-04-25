<?php

namespace App\Http\Controllers\Cadastros;

use App\Http\Controllers\Controller;

use App\Http\Requests\ClinicasRequest;
use App\Http\Requests\ClinicasUpdateRequest;
use App\Http\Requests\DefaultRequest;

use App\Services\ServiceClinica;
use Inertia\Inertia;

class ClinicaController extends Controller
{
     /**
     * @var ServiceClinica
     */
    private $clinica;
    
        public function __construct(ServiceClinica $clinica)
       {
            $this->middleware('permission:clinica-list|clinica-create|clinica-edit|clinica-delete', ['only' => 'index']);
            $this->middleware('permission:clinica-create', ['only' => ['create','store']]);
            $this->middleware('permission:clinica-edit', ['only' => ['edit','update']]);
            $this->middleware('permission:clinica-delete', ['only' => ['destroy']]);
            $this->clinica = $clinica;
       }
    
        /**
         * @return getClinica
         */
        public function getClinica()
        {
            return $this->clinica;
        }
            
    public function index(DefaultRequest $request)
    {
        $search = $request->get('search');
        if($search){
            
                 $clinicas = $this->getClinica()->search($search);
                 
        }else{
            $clinicas = $this->getClinica()->all();

        }
        return Inertia::render('Cadastros/Clinicas/index',[
            'clinicas' => $clinicas
        ]);

        
    }

    public function create()
    {
        return Inertia::render('Cadastros/Clinicas/create');
    }


    public function store(ClinicasRequest $request)
    {
        $clinica = $this->getClinica()->create($request->all());

        if ($clinica)
        {
            return redirect()->route('clinica.index')
                ->with('success','Clinica Cadastrada com Sucesso.');
        }

        return redirect()->route('clinica.index')->errors()->all();
    }

    public function show($id)
    {
        $clinica = $this->getClinica()->show($id);

        return Inertia('Cadastros/Clinicas/show',[
            'clinica' => $clinica
        ]);

    }

    public function edit($id)
    {
        $clinica = $this->getClinica()->show($id);

        return Inertia('Cadastros/Clinicas/edit',[
            'clinica' => $clinica
        ]);

    }

    public function update(ClinicasUpdateRequest $request, $id)
    {
        $clinica = $this->getClinica()->update($request->all(),$id);

        if ($clinica)
        {
            return redirect()->route('clinica.index')
                ->with('success','Clinica Atualizada com Sucesso.');
        }

        return redirect()->route('clinica.index')->errors()->all();
    }

    public function destroy($id)
    {
        $clinica = $this->getClinica()->delete($id);

        if ($clinica)
        {
            return redirect()->route('clinica.index')
                ->with('success','Clinica Excluida com Sucesso.');
        }

        return redirect()->route('clinica.index')->errors()->all();

    }

    public function search(DefaultRequest $request)
    {
        $data = $request->all();

        $filters = $request->except('_token');

        $clinica = $this->getClinica()->search($data);

        return view('ntc.cadastros.clinica.index',compact('clinica','filters'));

    }
}
