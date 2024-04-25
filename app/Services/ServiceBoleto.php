<?php
/**
 * Created by PhpStorm.
 * User: IncludeDEV
 * Date: 25/01/2017
 * Time: 13:41
 */

namespace App\Services;

use App\Models\Aluno;
use App\Models\Boleto;
use App\Models\Venda;
use App\Models\Voucher;
use WebMaster\PagHiper\PagHiper;

class ServiceBoleto
{

    /**
     * @var Boleto
     */
    private $boleto;

    public function __construct(Boleto $boleto, Aluno $aluno, Venda $venda)
    {
       $this->boleto = $boleto;
       $this->aluno = $aluno;
       $this->venda = $venda;
    }

    public function getBoleto()
    {
        return $this->boleto;
    }

    public function getAluno()
    {
        return $this->aluno;
    }

    public function getVenda()
    {
        return $this->venda;
    }

    public function all()
    {
        return $this->getBoleto()
            ->with('venda','venda.aluno')
            // ->where('status','pending')
            ->where(function ($query){
                $query->where('cfc_id',auth()->user()->cfc_selecionado);
                
            })
            ->paginate();
    }

    public function byAlunoId($id)
    {
        return $this->getBoleto()
            ->with('aluno')
            ->where('aluno_id',$id)
            ->first();
    }

    public function find($id)
    {
        return $this->getBoleto()
            ->with(['venda', 'venda.aluno', 'venda.aluno.autoEscola', 'venda.pacote'])
            ->find($id);
    }

    public function gerarBoleto($data, $venda_id)
    {
        $aluno = $this->getAluno()->find($data['aluno_id']);

        $paghiper = new PagHiper(env('API_KEY_PAG'), env('TOKEN_PAG'));

        $order_id = $aluno->id.''.$aluno->cpf;

        $valor_servico = 0;

        $descricao = $data['nome_venda'];
        

        if(isset($data['cupom_desconto'])){
            $voucher = Voucher::where('hash',$data['cupom_desconto'])
                        ->where('validade','>=',date('Y-m-d'))->first();

            if($voucher){
                $valor_servico = $valor_servico - $this->converteValor($voucher->valor);
                $voucher->update(array('status' => 0));
            }
        }

        $valor_servico = $this->converteValor($data['valor_venda']);


        $transaction = $paghiper->billet()->create([
            'order_id' => $order_id,
            'payer_name' => $aluno->nome,
            'partners_id' => '53B2H3CZ',
            'payer_email' => $aluno->email,
            'payer_cpf_cnpj' => $aluno->cpf,
            'notification_url' => env('APP_URL').'/notification/paghiper',
            'type_bank_slip' => 'boletoa4',
            'days_due_date' => '30',
            'seller_description' => "Referente a:".$descricao."O aluno só poderá fazer o exame com boleto pago!",
            'items' => [[
                'description' => $descricao,
                'quantity' => 1,
                'item_id' => 1,
                'price_cents' => $valor_servico
            ]]
        ]);

        // activity()
        //         ->causedBy(auth()->user())
        //         ->log("BOLETO: foi gerado um novo boleto para o aluno {$aluno->nome}, CPF {$aluno->cpf}");

        return $this->salvarPagamento($transaction, $venda_id);

    }

    public function salvarPagamento($boleto, $venda_id)
    {
        $venda = $this->getVenda()->find($venda_id);

        $data = $boleto;
        $data['boleto'] = $boleto['bank_slip']['url_slip_pdf'];
        $data['user_id'] = auth()->user()->id;
        $data['cfc_id'] = auth()->user()->cfc_selecionado;
        $data['due_date'] = $boleto['due_date'];

        return $venda->boleto()->create($data);
    }

    public function AtualizarBoletoParaRecebido($aluno_id, $recebivel_id)
    {
        $aluno = $this->getAluno()->find($aluno_id);

        $data['recebido'] = 1;
        $data['recebivel_id'] = $recebivel_id;

        return $aluno->pagamento()->update($data);
    }


    function converteValor($valor)
    {
        $valor = trim($valor);
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", "", $valor);
        $valor = str_replace("-", "", $valor);
        $valor = str_replace("/", "", $valor);
        $valor = str_replace("%", "", $valor);
        $valor = str_replace("R$", "", $valor);
        $valor = str_replace(" ", "", $valor);
        return $valor;
    }

    function descricaoServicosDoPacote($servicos)
    {
        $descricao = [];

        foreach($servicos as $key => $servico)
        {
            array_push($descricao, $servico->nome);
        }

        return implode("-", $descricao);
    }

    public function removePontoCpf($cpf)
    {
       $data = str_replace(array('.', ',','-',':',' ','/'), '', $cpf);

       return strval($data);
    }

    public function search($request)
    {
            return $this->getBoleto()
                ->with('aluno')
                ->join('alunos','boletos.aluno_id','=','alunos.id')
                ->where(function ($query) use ($request) {

                    if (isset($request['nome'])) {
                        $filter = $request['nome'];
                        $query->where(function ($querySub) use ($filter) {
                            $querySub->where('alunos.nome', 'LIKE', "%{$filter}%");
                        });
                    }

                    if (isset($request['cpf'])) {
                        $filter = limparMascara($request['cpf']);
                        $query->where(function ($querySub) use ($filter) {
                            $querySub->where('alunos.cpf', 'LIKE', "%{$filter}%");
                        });
                    }

                    if (isset($data['financeiro'])) {

                        if($data['financeiro'] == 'boleto_pendente')
                        {
                            $query->where(['boleto_status_pagamento' =>  'pending']);
                        }

                        if($data['financeiro'] == 'boleto_cancelado')
                        {
                            $query->where(['boleto_status_pagamento' =>  'canceled']);
                        }

                        if($data['financeiro'] == 'paid')
                        {
                            $query
                                ->where(function ($query){
                                    $query->where('boleto_status_pagamento',"paid");
                                    $query->orWhere('boleto_status_pagamento',"completed");
                                });
                        }
                    }

                    if (isset($request['boleto_transaction'])) {
                        $filter = $request['boleto_transaction'];
                        $query->where(function ($querySub) use ($filter) {
                            $querySub->where('alunos.boleto_transaction', 'LIKE', "%{$filter}%");
                        });
                    }

                    if(auth()->user()->hasRole('Clinica')){
                        $query->where('alunos.cfc_id',auth()->user()->cfc_id);
                    }
                    if(auth()->user()->hasRole('Auto Escola')){
                        $query->where('alunos.auto_escola_id',auth()->user()->auto_escola_id);
                    }
                })
                ->select('boletos.*','alunos.nome','alunos.cpf')
                ->orderBy('id','desc')
                ->paginate();
        }
}
