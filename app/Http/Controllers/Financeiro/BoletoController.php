<?php

namespace App\Http\Controllers\Financeiro;

use Inertia\Inertia;
use App\Models\Boleto;
use App\Services\ServiceAluno;
use App\Services\ServiceBoleto;
use WebMaster\PagHiper\PagHiper;
use App\Http\Controllers\Controller;
use App\Http\Requests\DefaultRequest;
use App\Services\ServiceCreditoCFC;

class BoletoController extends Controller
{

    /**
     * @var Boleto
     */
    private $boleto;
    /**
     * @var Aluno
     */
    private $aluno;

    private $modelBoleto;

    private $creditoCFC;

    public function __construct(ServiceBoleto $boleto, ServiceAluno $aluno, Boleto $modelBoleto, ServiceCreditoCFC $creditoCFC)
    {
        $this->middleware('permission:boleto-list-aluno|boleto-cancelar', ['only' => 'alunos']);
        $this->middleware('permission:boleto-cancelar', ['only' => ['cancelar']]);
        $this->boleto = $boleto;
        $this->aluno = $aluno;
        $this->modelBoleto = $modelBoleto;
        $this->creditoCFC = $creditoCFC;
    }

    /**
     * @return getBoleto
     */
    public function getBoleto()
    {
        return $this->boleto;
    }

    /**
     * @return getAluno
     */
    public function getAluno()
    {
        return $this->aluno;
    }

    /**
     * @return getModelBoleto
     */
    public function getModelBoleto()
    {
        return $this->modelBoleto;
    }

    public function getCreditoCFC()
    {
        return $this->creditoCFC;
    }

    public function index()
    {
        $boletos = $this->getBoleto()->all();


        return Inertia::render('Financeiro/Boletos/index',
            [
                'boletos'=> $boletos,
            ]
        );
    }

    public function gerarBoleto(DefaultRequest $request, $venda_id)
    {
        $data = $request->all();

        $boleto = $this->getBoleto()->gerarBoleto($data, $venda_id);

        if ($boleto)
            return redirect()->route('aluno.show', $data['aluno_id'])->with('success', 'Boleto Gerado com Sucesso!');

        return redirect()->route('aluno.show', $data['aluno_id'])->errors()->all();
    }

    public function cancelar($transaction_id)
    {
        $paghiper = new PagHiper(env('API_KEY_PAG'), env('TOKEN_PAG'));

        $cancelamento = $paghiper->billet()->cancel($transaction_id);

        if ($cancelamento)
            return redirect()->back()->with('success', 'Solicitação de cancelamento enviado com sucesso! Em alguns minutos seu boleto será cancelado!');

        return redirect()->back()->errors()->all();
    }

    public function notificacao(DefaultRequest $request)
    {
        $notification = $request->all();

        $paghiper = new PagHiper(env('API_KEY_PAG'), env('TOKEN_PAG'));

        $transaction = $paghiper->notification()->response($notification['notification_id'], $notification['transaction_id']);

        $boleto = $this->getModelBoleto()
                        ->with('venda', 'venda.pacote')
                        ->where('transaction_id', $notification['transaction_id'])
                        ->first();


        $data['status'] = $transaction['status'];
        $data['paid_date'] = $notification['paid_date'];

        if(($boleto->status == 'paid' || $boleto->status == 'completed') && $boleto->venda->pacote->desconto_boleto == 1){    
            $this->getCreditoCFC()->inserirCreditosByBoleto($boleto->id);
        }

        $boleto->update($data);
    }

    public function search(DefaultRequest $request)
    {
        $filters = $request->except('_token');

        $boletos = $this->getBoleto()->search($request->all());

        return view('ntc.financeiro.boletos.index', compact('boletos','filters'));
    }
}
