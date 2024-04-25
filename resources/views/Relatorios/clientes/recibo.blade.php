{{--<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ asset("css/relatorio.css") }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" rel="javascript">

    <title>Grupo Lima CFC</title>

</head>

<body>


<div>


    <h1 align="center" class="alert alert-success">Recibo de Servico</h1>

    <h4 align="right">Recibo Nº <small>{{$aluno->id}}</small></h4>

    <h4>Nome: <small>{{$aluno->nome}}</small></h4>
    <h4>CPF: <small>{{$aluno->cpf}}</small></h4>
    <h4>Clinica: <small>{{$aluno->clinica->nome}}</small></h4>

    <br>

    <div class="row">

        <table class="table">
            <thead>
            <tr>
                <th scope="col" width="60%">Descrição</th>
                <th scope="col">Data de Pagamento</th>
                <th scope="col">Valor</th>
                <th scope="col">Forma de Pagamento</th>
            </tr>
            </thead>


            <tbody>
            <tr>
                <td align="center">{!! $financeiro->descricao !!}</td>
                <td align="center">{{date('d/m/Y',strtotime($financeiro->created_at))}}</td>
                <td align="center">{{floatToMoney($financeiro->valor)}}</td>
                <td align="center">{!! $financeiro->forma_pagamento !!}</td>
            </tr>
            </tbody> 
        </table>
    </div>

    <br><br><br>

     <div class="row" align="center">
        Informamos que recebemos a importância no valor de {{floatToMoney($financeiro->valor)}} detalhado acima.
    </div> 

    <br>
    <br>

        <p align="center">Fortaleza - CE, {{date('d/m/Y')}}</p>

        <br><br>

        <hr align="center" width="200" size="3" color="black" id="assinatura">

        <p align="center">{{ Auth::user()->name }}</p>

</div>
</body>
</html> --}}
<div class="receipt-main">
  
    <p class="receipt-title">Recibo</p>
    
    <div class="receipt-section pull-left">
      <span class="receipt-label text-large">Número:{{$aluno->id}}</span>
      <span class="receipt-label text-large">data:</span>
      <span class="text-large">{{$datarecibo}}</span>
    </div>
    @foreach ($aluno->vendas as $venda)
    <div class="pull-right receipt-section">
      <span class="text-large receipt-label">R$</span>
      <span class="text-large">{{$venda->valor_venda}}</span>
    </div>
    @endforeach
    <div class="clearfix"></div>
    
    <div class="receipt-section">
      <span class="receipt-label">Beneficiário:</span>
      <span>{{$aluno->nome}}</span>
      <span class="receipt-label"> CPF:</span>
      <span>{{$aluno->cpf}}</span>
    </div>
    
    <div class="receipt-section">
      <span class="receipt-label">Responsável:</span>
      <span>{{ Auth::user()->name }}</span>
    </div>
    
    <div class="receipt-section">
      <p>Recebi de {{$aluno->nome}} a importância de R${{$venda->valor_venda}}</p>
      <p>Referente a meus serviços profissionais</p>
    </div>
    
    <div class="receipt-section">
      <p class="pull-right text-large">Ceará, {{$datarecibo}}</p>
    </div>
    
    <div class="clearfix"> <div class="receipt-signature col-xs-4">
        <p class="receipt-line"></p>
        <p>{{$aluno->nome}}</p>
        <p>{{$aluno->cpf}}</p>
      </div></div>
   
    <div class="receipt-signature col-xs-4">
      <p class="receipt-line"></p>
      <p>{{$aluno->clinica->nome}}</p>
      <p>33.567.965/0001-10</p>
      <p>Rua Godofredo Maciel, 4000 - Mondubim</p>
      <p>Ceará - CE - 60.711-502</p>
    </div>
  
   
    <style type="text/css" >
        body {
  padding: 50px;
}

* {
  box-sizing: border-box;
}

.receipt-main {
  display: inline-block;
  width: 100%;
  padding: 15px;
  font-size: 12px;
  border: 1px solid #000;
}

.receipt-title {
  text-align: center;
  text-transform: uppercase;
  font-size: 20px;
  font-weight: 600;
  margin: 0;
}
  
.receipt-label {
  font-weight: 600;
}

.text-large {
  font-size: 16px;
}

.receipt-section {
  margin-top: 10px;
}

.receipt-footer {
  text-align: center;
  background: #ff0000;
}

.receipt-signature {
  height: 80px;
  margin: 50px 0;
  padding: 0 50px;
  background: #fff;
  
  .receipt-line {
    margin-bottom: 10px;
    border-bottom: 1px solid #000;
  }
  
  p {
    text-align: center;
    margin: 0;
  }
}

    </style>
  </div>