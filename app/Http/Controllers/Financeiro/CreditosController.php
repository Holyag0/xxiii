<?php

namespace App\Http\Controllers\Financeiro;

use Inertia\Inertia;
use App\Models\Boleto;
use Illuminate\Http\Request;
use App\Services\ServiceAluno;
use App\Services\ServiceBoleto;
use WebMaster\PagHiper\PagHiper;
use App\Services\ServiceCreditoCFC;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreditoRequest;
use App\Http\Requests\DefaultRequest;
use App\Services\ServiceCfc;

class CreditosController extends Controller
{
    private $creditoCFC;
    private $autoEscola;

    public function __construct(ServiceCreditoCFC $creditoCFC, ServiceCfc $autoEscola)
    {
        $this->middleware('permission:creditos-list|creditos-cancelar', ['only' => 'alunos']);
        $this->middleware('permission:creditos-cancelar', ['only' => ['cancelar']]);
        $this->creditoCFC = $creditoCFC;
        $this->autoEscola = $autoEscola;
    }

    public function getCreditoCFC()
    {
        return $this->creditoCFC;
    }
    public function getAutoEscola()
    {
        return $this->autoEscola;
    }

    public function menuCreditos()
    {
        $autoEscolas = $this->getAutoEscola()->buscaCfcPorCreditos();


        return Inertia::render('MenuCreditos/index',[
            'autoEscolas' => $autoEscolas
        ]);
    }

    public function visualizarCreditos($auto_escola_id)
    {
        $creditosDisponiveis = $this->getCreditoCFC()->visualizarCreditos($auto_escola_id);

        return Inertia::render(
            'MenuCreditos/creditosDisponiveis',
            [
                'creditosDisponiveis'=> $creditosDisponiveis,
                'auto_escola_id' => $auto_escola_id
            ]
        );
    }

    public function solicitarCreditos($auto_escola_id)
    {
        $creditosDisponiveis = $this->getCreditoCFC()->visualizarCreditos($auto_escola_id);

        return Inertia::render(
            'MenuCreditos/solicitarCreditos',
            [
                'creditosDisponiveis'=> $creditosDisponiveis,
                'auto_escola_id' => $auto_escola_id
            ]
        );
    }

    public function aprovarCreditoAutoEscola(CreditoRequest $request)
    {
        $credito = $this->getCreditoCFC()->aprovarCreditoAutoEscola($request->all());

        if ($credito)
        {
            return redirect()->route('menuCreditos')->with('success', 'Credito Solicitado com Sucesso!');
        }

        return redirect()->back()->errors()->all();
    }
    
}
