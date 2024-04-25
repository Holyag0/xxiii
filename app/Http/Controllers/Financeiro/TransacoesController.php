<?php

namespace App\Http\Controllers\Financeiro;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Requests\DefaultRequest;
use App\Services\ServiceContasDigitais;
use App\Http\Requests\TransferenciaRequest;
use App\Services\ServiceTransacao;
use Illuminate\Http\Request;

class TransacoesController extends Controller
{

    private $contas;
    private $serviceTransacoes;

    public function __construct(ServiceContasDigitais $contas, ServiceTransacao $serviceTransacoes)
    {
        $this->middleware('permission:transacoes-list|transacoes-create|transacoes-edit|transacoes-delete', ['only' => 'index']);
        $this->middleware('permission:transacoes-create', ['only' => ['create','store']]);
        $this->middleware('permission:transacoes-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:transacoes-delete', ['only' => ['destroy']]);
        $this->contas = $contas;
        $this->serviceTransacoes = $serviceTransacoes;
    }

    public function getContas()
    {
        return $this->contas;
    }

    public function getTransacoes()
    {
        return $this->serviceTransacoes;
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        $conta = 0;

        if ($search) {
            $transacoes = $this->getTransacoes()->search($search);
            
            if(isset($search['conta_id']))
                $conta = $this->getContas()->show($search['conta_id']);

        }else{
            $transacoes = $this->getTransacoes()->all();
        }
        
        $contas = $this->getContas()->contasList();

        return Inertia::render('MenuContas/Transacoes/index',[
            'transacoes' => $transacoes,
            'contas' => $contas,
            'conta' => $conta
        ]);
    }

    public function search(DefaultRequest $request)
    {
        $data = $request->all();

        $filters = $request->except('_token');

        $contas = $this->getContas()->search($data);
        $clinicas = $this->getClinicas()->clinicaList();

        return view('ntc.financeiro.transacoes.index',compact('contas','filters','clinicas'));

    }


}
