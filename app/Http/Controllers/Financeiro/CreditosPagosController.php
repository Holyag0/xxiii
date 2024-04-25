<?php

namespace App\Http\Controllers\Financeiro;

use Inertia\Inertia;
use App\Services\ServiceRecebiveis;
use App\Http\Controllers\Controller;
use App\Http\Requests\DefaultRequest;
use App\Services\ServiceCfc;
use Spatie\Activitylog\Models\Activity;
use App\Services\ServiceCreditoCFCPagos;


class CreditosPagosController extends Controller
{

    /**
     * @var ServiceRecebiveis
     */
    private $creditosPagos;   

    /**
     * @var ServiceCfc
     */
    private $autoEscola;    

    public function __construct(
        ServiceCreditoCFCPagos $creditosPagos,
        ServiceCfc $autoEscola
        )
    {
        $this->middleware('permission:creditosPagos-visualizar', ['only' => ['visualizar']]);
        $this->creditosPagos = $creditosPagos;
        $this->autoEscola = $autoEscola;
    }

    /**
     * @return getRecebiveis
     */
    public function getCreditosPagos()
    {
        return $this->creditosPagos;
    } 

    /**
     * @return getAutoEscola
     */
    public function getAutoEscola()
    {
        return $this->autoEscola;
    } 

    public function visualizar($auto_escola_id)
    {
        $creditosPagos = $this->getCreditosPagos()->visualizarCreditos($auto_escola_id);

        return Inertia::render(
            'MenuCreditos/creditosPagos',
            [
                'creditosPagos'=> $creditosPagos,
                'auto_escola_id' => $auto_escola_id
            ]
        );
    }
}
