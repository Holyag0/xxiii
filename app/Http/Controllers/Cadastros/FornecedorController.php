<?php

namespace App\Http\Controllers\Cadastros;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\FornecedorRequest;
use App\Http\Requests\FornecedorUpdateRequest;
use App\Services\ServiceFornecedor;
use Inertia\Inertia;

class FornecedorController extends Controller
{
    private $fornecedores;

    public function __construct(ServiceFornecedor $fornecedores)
    {
        $this->middleware('permission:fornecedor-list|fornecedor-create|fornecedor-edit|fornecedor-delete', ['only' => 'index']);
        $this->middleware('permission:fornecedor-create', ['only' => ['create','store']]);
        $this->middleware('permission:fornecedor-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:fornecedor-delete', ['only' => ['destroy']]);
        $this->fornecedores = $fornecedores;
    }

    public function getFornecedor(){
        return $this->fornecedores;
    }

    public function index(){
        $fornecedores = $this->getFornecedor()->all();

        return Inertia::render('Cadastros/Fornecedores/index',[
            'fornecedores' => $fornecedores
        ]);
    }

    public function create(){
        return Inertia::render('Cadastros/Fornecedores/create');
    }

    public function show($id){
        $fornecedor = $this->getFornecedor()->show($id);

        return Inertia::render('Cadastros/Fornecedores/show',[
            'fornecedor' => $fornecedor
        ]);
    }

    public function edit($id){
        $fornecedor = $this->getFornecedor()->show($id);

        return Inertia::render('Cadastros/Fornecedores/edit',[
            'fornecedor' => $fornecedor
        ]);
    }


    public function update(FornecedorUpdateRequest $request, $id){

        $fornecedor = $this->getFornecedor()->update($request->all(),$id);

        if ($fornecedor)
            return redirect()->route('fornecedores.index')->with('success','Fornecedor Atualizado com Sucesso.');

        return redirect()->route('fornecedores.index')->errors()->all();
    }


    public function store(FornecedorRequest $request){
        $fornecedor = $this->getFornecedor()->create($request->all());

        if ($fornecedor) {
            return redirect()->route('fornecedores.index')->with('success', 'Fornecedor Cadastrado com Sucesso.');
        }

        return redirect()->route('fornecedores.index')->errors()->all();
    }

}
