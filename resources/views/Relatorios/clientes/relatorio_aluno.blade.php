<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    
    <title>Relatório de Clientes</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

   <style>
        .page-break {
            page-break-after: always;
        }
    </style>

  </head>

  <body>
    <div class="card-tools">

    </div>

        <h1 class="text-center">Relatorio de Clientes</h1>
        <p>
            {{-- <strong>Data: </strong> De {{Carbon::parse($data['data_inicio'])->format('d/m/Y')}} a {{Carbon::parse($data['data_fim'])->format('d/m/Y')}} --}}
        </p>

        <p>
            <strong>
                Filtrado por:
            </strong>
                @isset($data['cfc'])Auto Escola - @endisset
                {{-- @isset($data['financeiro'])Status Financeiro - @endisset --}}
                @isset($data['status'])Status do Cliente @endisset
        </p>


        <table class="table table-striped table-bordered table-sm">

        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                @if(!auth()->user()->hasRole('Avulso'))
                    <th>CFC</th>
                @endif
                <th>Id</th>
                <th>Receita Nome/th>
                <th>data_pagamento</th>
                <th>Status</th>
            </tr>
        </thead>


        <tbody>
            @foreach($alunos as $aluno)
                <tr>
                    <td>{{$aluno->id}}</td>
                    <td>{{$aluno->nome}}</td>
                    <td>
                        {{$aluno->autoEscola->nome}}
                    </td>
                    <td>{{$aluno->created_at}}</td>
                    {{-- <td>{{isset($aluno->pacote->nome) ? $aluno->pacote->nome : ''}}</td>
                    <td class="justify-content-center">
                        {!! $aluno->StatusPagamento !!}
                    </td>
                    <td>
                    {{$aluno->status ? $aluno->status : 'A fazer'}}
                    </td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>

        <br>
        <hr>
        <footer class="main-footer">
            <h3 class="text-center">NTC Núcleo de Trânsito do Ceará</h3>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    </body>
</html>
 