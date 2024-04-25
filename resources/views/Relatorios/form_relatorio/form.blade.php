<div class="modal fade form_relatorio">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Relatorio de Receitas</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="relatorio_geral" action="{{route('receita.relatorio')}}" method="post" class="form">
          @csrf

            <div class="row">
                <div class="col-md-6">
                  <label class="mr-sm-2" for="data_inicio">Data Inícial</label>
                  <input type="date" name="data_inicio" class="form-control" id="data" placeholder="Data:">
                </div>

                <div class="col-md-6">
                  <label class="mr-sm-2" for="data_fim">Data Final</label>
                  <input type="date" name="data_fim" class="form-control" id="data" placeholder="Data:">
                </div>
            </div>

            <hr>

            <div class="row">
              @if(auth()->user()->hasRole(['Admin', 'Clinica']))
                @isset($autoEscola)
                  <div class="col-md-12">
                    <label class="mr-sm-2" for="nome">Auto Escola</label>
                    {{ Form::select('cfc',$autoEscola,null,['class'=>'form-control','placeholder'=>'Auto Escola']) }}
                  </div>
                @endisset
              @endif
            </div>

            <hr>

            <div class="row">
                <div class="col-md-6">
                    <label class="mr-sm-2" for="status">Status</label>
                    <select name="status" class="form-control">
                      <option value="">Status</option>


                          <option value="0">Á receber</option>

                          <option value="Perícia">Perícia</option>

                          <option value="Inapto Temporariamente">Inapto Temporariamente</option>

                          <option value="Aprovado">Aprovado</option>

                          <option value="Remarcado">Remarcado</option>

                    </select>
                </div>

                {{-- <div class="col-md-6">
                    <label class="mr-sm-2" for="status">Financeiro</label>
                    <select name="financeiro" class="form-control">
                      <option value="">Status</option>

                        <option value="paid">Pagamento Efetuado</option>

                        <option value="pendente">Pagamento Pendente</option>

                        <option value="boleto_pendente">Boleto Pendente</option>

                        <option value="boleto_cancelado">Boleto Cancelado</option>

                    </select>
                </div>
            </div> --}}

          </div>

          <br>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-sm btn-success float-sm-right">Gerar Relatório</a>
          </div>

        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
