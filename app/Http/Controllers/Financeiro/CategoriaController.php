<?php

namespace App\Http\Controllers\Financeiro;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriaRequest;
use App\Services\ServiceCategorias;
use Inertia\Inertia;

class CategoriaController extends Controller
{
    private $categorias;


    public function __construct(ServiceCategorias $categorias)
    {
        $this->middleware('permission:categoria-list|categoria-create|categoria-edit|categoria-delete', ['only' => 'index']);
        $this->middleware('permission:categoria-create', ['only' => ['create','store']]);
        $this->middleware('permission:categoria-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:categoria-delete', ['only' => ['destroy']]);
        $this->categorias =$categorias;
    }


    public function getCategorias(){

        return $this->categorias;
    }

    public function index(){
        
        $categorias = $this->getCategorias()->all();

        return Inertia::render('Financeiro/Categorias/index',[
            'categorias' => $categorias
        ]);
    }

    public function create()
    {
        return Inertia::render('Financeiro/Categorias/create');
    }

    public function show($id){
        $categoria = $this->getCategorias()->show($id);

        return Inertia::render('Financeiro/Categorias/show',[
            'categoria' => $categoria
        ]);
    }

    public function store(CategoriaRequest $request){
        
        $categoria = $this->getCategorias()->create($request->all());

        if ($categoria){
            return redirect()->route('categorias.index')
                ->with('success', 'Categoria Cadastrada com Sucesso!');
        }

        return redirect()->route('categorias.index')->errors()->all();

    }

    public function edit($id){
        $categoria = $this->getCategorias()->show($id);

        return Inertia::render('Financeiro/Categorias/edit',[
            'categoria' => $categoria
        ]);
    }


    public function update(CategoriaRequest $request, $id){

        $categoria= $this->getCategorias()->update($request->all(),$id);

        if ($categoria)
        {
            return redirect()->route('categorias.index')
                ->with('success', 'Categorias Alterada com Sucesso!');
        }

        return redirect()->route('categorias.index')->errors()->all();
    }

}
