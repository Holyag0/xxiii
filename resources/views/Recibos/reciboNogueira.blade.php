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
      <p>37.338.791/0001-89</p>
      <p>Rua. Desembargador Lauro Nogueira, 1316 - Papicu</p>
      <p>Ceará - CE - 60.176-065</p>
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