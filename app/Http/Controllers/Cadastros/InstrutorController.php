<?php

namespace App\Http\Controllers\Cadastros;

use App\Http\Controllers\Controller;
use App\Http\Requests\InstrutoresUpdateRequest;
use App\Http\Requests\InstrutorRequest;
use App\Services\ServiceInstrutor;
use Inertia\Inertia;

class InstrutorController extends Controller
{       
    private $instrutor;
    public function __construct(ServiceInstrutor $instrutor)
    {
        $this->middleware('permission:instrutor-list|instrutor-create|instrutor-edit|instrutor-delete', ['only' => 'index']);
        $this->middleware('permission:instrutor-create', ['only' => ['create','store']]);
        $this->middleware('permission:instrutor-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:instrutor-delete', ['only' => ['destroy']]);
        $this->instrutor = $instrutor;
    }

    public function getInstrutores(){
        return $this->instrutor;
    }
    public function index(){
        
        $instrutores = $this->getInstrutores()->all();

        return Inertia::render('Cadastros/Instrutores/index',[
            'instrutores' => $instrutores
        ]);
    }

    public function create()
    {
        return Inertia::render('Cadastros/Instrutores/create');
    }

    public function show($id){
        $instrutor = $this->getInstrutores()->show($id);

        return Inertia::render('Cadastros/Instrutores/show',[
            'instrutor' => $instrutor
        ]);
    }

    public function store(InstrutorRequest $request){
        
        $instrutores = $this->getInstrutores()->create($request->all());

        if ($instrutores){
            return redirect()->route('instrutor.index')
                ->with('success', 'Instrutor Cadastrado com Sucesso!');
        }

        return redirect()->route('instrutor.index')->errors()->all();

    }

    public function edit($id){
        $instrutor = $this->getInstrutores()->show($id);

        return Inertia::render('Cadastros/Instrutores/edit',[
            'instrutor' => $instrutor
        ]);
    }


    public function update(InstrutoresUpdateRequest $request, $id){

        $instrutores= $this->getInstrutores()->update($request->all(),$id);

        if ($instrutores)
        {
            return redirect()->route('instrutor.index')
                ->with('success', 'Instrutor Alterado com Sucesso!');
        }

        return redirect()->route('instrutor.index')->errors()->all();
    }

}

    

