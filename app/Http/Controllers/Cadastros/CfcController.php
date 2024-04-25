<?php

namespace App\Http\Controllers\Cadastros;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClinicasRequest;
use App\Http\Requests\ClinicasUpdateRequest;
use App\Http\Requests\DefaultRequest;
use App\Services\ServiceCfc;
use Inertia\Inertia;

class CfcController extends Controller
{
    /**
     * @var ServiceCfc
     */
    private $cfc;

    public function __construct(ServiceCfc $cfc)
    {
        $this->middleware('permission:cfc-list|cfc-create|cfc-edit|cfc-delete', ['only' => 'index']);
        $this->middleware('permission:cfc-create', ['only' => ['create','store']]);
        $this->middleware('permission:cfc-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:cfc-delete', ['only' => ['destroy']]);
        $this->cfc = $cfc;
    }

    /**
     * @return getCfc
     */
    public function getCfc()
    {
        return $this->cfc;
    }

    public function index()
    {
        $cfcs = $this->getCfc()->all();

        return Inertia::render('Cadastros/Cfc/index',[
            'cfcs' => $cfcs
        ]);
    }

    public function create()
    {      
        return Inertia::render('Cadastros/Cfc/create');
    }


    public function store(ClinicasRequest $request)
    {
        $cfcs = $this->getCfc()->create($request->all());

        if ($cfcs)
        {
            return redirect()->route('cfc.index')
                ->with('success','Auto Escola Cadastrada com Sucesso.');
        }

        return redirect()->route('cfc.index')->errors()->all();
    }

    public function show($id)
    {
        $cfc = $this->getCfc()->show($id);

        return Inertia('Cadastros/Cfc/show',[
            'cfc' => $cfc
        ]);
    }

    public function edit($id)
    {
        $cfc = $this->getCfc()->show($id);

        return Inertia::render('Cadastros/Cfc/edit',[
            'cfc' => $cfc
        ]);

    }

    public function update(ClinicasUpdateRequest $request, $id)
    {
        $cfc = $this->getCfc()->update($request->all(),$id);

        if ($cfc)
        {
            $response = [
                'message' => 'Auto Escola Alterada com Sucesso.'
            ];
            return redirect()->route('cfc.index')->with('message', $response['message']);
        }

        return redirect()->route('cfc.index')->errors()->all();
    }

    public function destroy($id)
    {
        $cfc = $this->getCfc()->delete($id);

        if ($cfc)
        {
            $response = [
                'message' => 'Auto Escola Deletada com Sucesso.'
            ];
            return redirect()->route('cfc.index')->with('message', $response['message']);
        }

        return redirect()->route('cfc.index')->errors()->all();

    }

    public function search(DefaultRequest $request)
    {
        $data = $request->all();

        $filters = $request->except('_token');

        $cfcs = $this->getCfc()->search($data);

        return Inertia::render('Cadastros/Cfc/index',[
            'cfcs' => $cfcs,
            'filters' => $filters
        ]);

    }

}
