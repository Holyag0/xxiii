<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Exames\ExamesController;
use App\Http\Controllers\Comercial\VendasController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Cadastros\RoleController;
use App\Http\Controllers\Cadastros\UserController;
use App\Http\Controllers\Cadastros\AlunoController;
use App\Http\Controllers\Comercial\PacoteController;
use App\Http\Controllers\Financeiro\BoletoController;
use App\Http\Controllers\Cadastros\ClinicaController;
use App\Http\Controllers\Comercial\ServicosController;
use App\Http\Controllers\Comercial\ProcessosController;
use App\Http\Controllers\Financeiro\DespesasController;
use App\Http\Controllers\Financeiro\ReceitasController;
use App\Http\Controllers\Cadastros\CfcController;
use App\Http\Controllers\Financeiro\CategoriaController;
use App\Http\Controllers\Cadastros\ColaboradorController;
use App\Http\Controllers\Cadastros\FornecedorController;
use App\Http\Controllers\Cadastros\InstrutorController;
use App\Http\Controllers\Financeiro\TransacoesController;
use App\Http\Controllers\Financeiro\CentroCustoController;
use App\Http\Controllers\Financeiro\ContasDigitaisController;
use App\Http\Controllers\Financeiro\TransferenciasController;

Route::get('login', [LoginController::class, 'create'])->name('login');
Route::post('login', [LoginController::class, 'store']);

Route::post('notification/paghiper/', [BoletoController::class, 'notificacao']);

Route::middleware(['auth'])->group(function(){
    Route::get('/menu-alterna-unidade', [MenuController::class, 'menuAlternaUnidade'])->name('menuAlternaUnidade');
    Route::get('/alterna-unidade/{id}', [MenuController::class, 'alternaUnidade'])->name('alternaUnidade');
});

Route::middleware(['auth', 'seleciona_unidade'])->group(function(){
    
    Route::get('/', function () {
        return inertia('Home');
    })->name('home'); 

    Route::get('logout', [LoginController::class, 'destroy'])->middleware('auth');

    Route::get('/menu-cadastros', [MenuController::class, 'menuCadastros'])->name('menuCadastros');
    Route::get('/menu-comercial', [MenuController::class, 'menuComercial'])->name('menuComercial');
    Route::get('/menu-financeiro', [MenuController::class, 'menuFinanceiro'])->name('menuFinanceiro');
    Route::get('/menu-contas', [MenuController::class, 'menuContas'])->name('menuContas');

    /**INICIO ROTAS DO MÓDULO DE CADASTRO**/
    Route::group(['prefix' => 'cadastros'], function () {
        Route::resource('user', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('clinica', ClinicaController::class);
        Route::resource('colaboradores', ColaboradorController::class);
        Route::resource('cfc', CfcController::class);
        Route::resource('aluno', AlunoController::class);
        Route::resource('instrutor', InstrutorController::class);
        Route::resource('fornecedores', FornecedorController::class);
       
    });

    Route::group(['prefix' => 'comercial'], function () {
        Route::resource('processo',ProcessosController::class);
        Route::resource('vendas',VendasController::class);
        Route::resource('servico', ServicosController::class);
        Route::resource('pacote', PacoteController::class);
        Route::get('venda/baixar-venda/{id}',[VendasController::class,'baixar'])->name('baixar.venda');
        Route::post('venda/efetuar-baixa/{id}',[VendasController::class,'baixarParcela'])->name('baixarParcela');
        Route::post('venda/reabrir-parcela/{id}',[VendasController::class,'reabrirParcela'])->name('reabrirParcela');
    });

    Route::group(['prefix' => 'financeiro'], function () {
        Route::resource('receitas', ReceitasController::class);
        Route::get('receitas/{id}/baixar', [ReceitasController::class, 'baixar'])->name('receitas.baixar');
        Route::post('receitas/efetuarbaixa', [ReceitasController::class, 'efetuarBaixa'])->name('receitas.efetuarBaixa');
        Route::get('receitas/{id}/reabrir', [ReceitasController::class, 'reabrir'])->name('receitas.reabrir');
        Route::get('form/relatorio/receita', [ReceitasController::class, 'gerearRelatorioReceitas'])->name('gerar.relatorio');
        Route::any('relatorio/receita', [ReceitasController::class, 'relatorios'])->name('receita.relatorio');
        Route::get('receitas/baixas/multiplas',[ReceitasController::class,'multiplaBaixa'])->name('multiplas.receitas');
        Route::post('receitas/efetuarbaixasMultiplas', [ReceitasController::class, 'efetuarBaixasMultiplas'])->name('receitas.efetuarBaixasMultiplas');
        
        Route::resource('despesas', DespesasController::class);
        Route::get('despesas/{id}/baixar', [DespesasController::class, 'baixar'])->name('despesas.baixar');
        Route::post('despesas/efetuarbaixa', [DespesasController::class, 'efetuarBaixa'])->name('despesas.efetuarBaixa');
        Route::get('despesas/{id}/reabrir', [DespesasController::class, 'reabrir'])->name('despesas.reabrir');
        Route::get('despesas/relatorio/filtro', [DespesasController::class,'gerearRelatorioDespesas'])->name('gerar_relatorio.despesa');
        Route::any('depesas/gerar/relatorio', [DespesasController::class,'relatoriosDespesas'])->name('relatorio.despesas');
        Route::get('depesas/vencimentos', [DespesasController::class,'despesaVencimento'])->name('depesas.vencimento');


        Route::resource('contas', ContasDigitaisController::class);   
        Route::resource('transacoes', TransacoesController::class);
        Route::resource('centro_custos', CentroCustoController::class);
        Route::resource('categorias', CategoriaController::class);
        Route::resource('transferencias',TransferenciasController::class);

        Route::resource('boletos', BoletoController::class);
        Route::post('/boleto/gerar/{id_venda}',[BoletoController::class,'gerarBoleto'])->name('gerarBoleto');
        Route::get('boletos/{id}/cancelar', [BoletoController::class, 'cancelar'])->name('boleto.cancelar');  
    });

    Route::resource('exames', ExamesController::class);
    Route::put('exames/index-Edit/{id}',[ExamesController::class,'indexUpdate'])->name('index.update');
    
    
    Route::get('/atendimentos', [AlunoController::class, 'index'])->name('atendimentos');
    Route::get('/aluno/recibo/{id}', [AlunoController::class,'downloadRecibo'])->name('recibo.aluno');
    Route::any('aluno/search', [AlunoController::class,'search'])->name('aluno.search');
    Route::get('aluno/gerar/relatorio',[AlunoController::class,'gerarRelatorioAluno'])->name('gerar_relatorio.aluno');
    Route::any('aluno/relatorio/', [AlunoController::class,'relatorios'])->name('aluno.relatorio');

    Route::any('cfc/search', [CfcController::class,'search'])->name('cfc.search');
});

