<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cfcPermissions = [];
        $atendimentoPermissions = [];
        $caixaPermissions = [];
        $gerenteAtendimentoPermissions = [];
        $financeiroPermissions = [];
        
        $allPermissions = Permission::all();

        foreach($allPermissions as $permission){
            switch ($permission->name) {

        
                case 'atendimentos':
                    $cfcPermissions[] += $permission->id;
                    $caixaPermissions[] += $permission->id;
                    $gerenteAtendimentoPermissions[] += $permission->id;
                    $atendimentoPermissions[] += $permission->id;
                    break;
                case 'aluno-list':
                    $cfcPermissions[] += $permission->id;
                    $caixaPermissions[] += $permission->id;
                    $atendimentoPermissions[] += $permission->id;
                    $gerenteAtendimentoPermissions[] += $permission->id;
                    break;
                case 'aluno-show':
                    $cfcPermissions[] += $permission->id;
                    $atendimentoPermissions[] += $permission->id;
                    $caixaPermissions[] += $permission->id;
                    $gerenteAtendimentoPermissions[] += $permission->id;
                    break;
                case 'aluno-cadastro':
                    $cfcPermissions[] += $permission->id;
                    $atendimentoPermissions[] += $permission->id;
                    $gerenteAtendimentoPermissions[] += $permission->id;
                    break;
                case 'aluno-create':
                    $cfcPermissions[] += $permission->id;
                    $atendimentoPermissions[] += $permission->id;
                    $gerenteAtendimentoPermissions[] += $permission->id;
                    break;
                case 'aluno-edit':
                    $cfcPermissions[] += $permission->id;
                    $gerenteAtendimentoPermissions[] += $permission->id;
                    $atendimentoPermissions[] += $permission->id;
                    break;
                case 'aluno-dados':
                    $cfcPermissions[] += $permission->id;
                    $atendimentoPermissions[] += $permission->id;
                    $caixaPermissions[] += $permission->id;
                    $gerenteAtendimentoPermissions[] += $permission->id;
                    break;
                case 'aluno-exames':
                    $cfcPermissions[] += $permission->id;
                    $gerenteAtendimentoPermissions[] += $permission->id;
                    break;
                case 'aluno-vendas':
                    $cfcPermissions[] += $permission->id;
                    $atendimentoPermissions[] += $permission->id;
                    $caixaPermissions[] += $permission->id;
                    $gerenteAtendimentoPermissions[] += $permission->id;
                    break;

                case 'cadastros':
                    $financeiroPermissions[] += $permission->id;
                    break;
                case 'cadastro-fornecedor':
                    $financeiroPermissions[] += $permission->id;
                    break;
                case 'fornecedor-list':
                    $financeiroPermissions[] += $permission->id;
                    break;
                case 'fornecedor-show':
                    $financeiroPermissions[] += $permission->id;
                    break;
                case 'fornecedor-create':
                    $financeiroPermissions[] += $permission->id;
                    break;
                case 'fornecedor-edit':
                    $financeiroPermissions[] += $permission->id;
                    break;
                case 'cadastro-colaborador':
                    $financeiroPermissions[] += $permission->id;
                    break;
                case 'colaborador-list':
                    $financeiroPermissions[] += $permission->id;
                    break;
                case 'colaborador-show':
                    $financeiroPermissions[] += $permission->id;
                    break;
                case 'colaborador-create':
                    $financeiroPermissions[] += $permission->id;
                    break;
                case 'colaborador-edit':
                    $financeiroPermissions[] += $permission->id;
                    break;
      
                case 'financeiro':
                    $financeiroPermissions[] += $permission->id;
                    $caixaPermissions[] += $permission->id;
                    break;
                case 'financeiro-receitas':
                    $financeiroPermissions[] += $permission->id;
                    $caixaPermissions[] += $permission->id;
                    break;
                case 'receita-list':
                    $financeiroPermissions[] += $permission->id;
                    $caixaPermissions[] += $permission->id;
                    break;
                case 'receita-show':
                    $financeiroPermissions[] += $permission->id;
                    $caixaPermissions[] += $permission->id;
                    break;
                case 'receita-create':
                    $financeiroPermissions[] += $permission->id;
                    $caixaPermissions[] += $permission->id;
                    break;
                case 'receita-edit':
                    $financeiroPermissions[] += $permission->id;
                    $caixaPermissions[] += $permission->id;
                    break;
                case 'receita-baixar':
                    $financeiroPermissions[] += $permission->id;
                    $caixaPermissions[] += $permission->id;
                    break;
                case 'receita-multipla':
                    $financeiroPermissions[] += $permission->id;
                    break;
                case 'financeiro-despesa':
                    $financeiroPermissions[] += $permission->id;
                    $caixaPermissions[] += $permission->id;
                    break;
                case 'despesa-list':
                    $financeiroPermissions[] += $permission->id;
                    $caixaPermissions[] += $permission->id;
                    break;
                case 'despesa-show':
                    $financeiroPermissions[] += $permission->id;
                    $caixaPermissions[] += $permission->id;
                    break;
                case 'despesa-create':
                    $financeiroPermissions[] += $permission->id;
                    $caixaPermissions[] += $permission->id;
                    break;
                case 'despesa-edit':
                    $financeiroPermissions[] += $permission->id;
                    $caixaPermissions[] += $permission->id;
                    break;
                case 'despesa-baixar':
                    $financeiroPermissions[] += $permission->id;
                    $caixaPermissions[] += $permission->id;
                    break;
                case 'financeiro-transferencia':
                    $financeiroPermissions[] += $permission->id;
                    break;
                case 'transferencia-list':
                    $financeiroPermissions[] += $permission->id;
                    break;
                case 'transferencia-show':
                    $financeiroPermissions[] += $permission->id;
                    break;
                case 'transferencia-create':
                    $financeiroPermissions[] += $permission->id;
                    break;
                
                case 'contas':
                    $financeiroPermissions[] += $permission->id;
                    $caixaPermissions[] += $permission->id;
                    break;
                case 'contas-list':
                    $financeiroPermissions[] += $permission->id;
                    break;
                case 'contas-show':
                    $financeiroPermissions[] += $permission->id;
                    break;

                case 'exames':
                    $gerenteAtendimentoPermissions[] += $permission->id;
                    break;
                case 'exame-list':
                    $gerenteAtendimentoPermissions[] += $permission->id;
                    break;
                case 'exame-show':
                    $gerenteAtendimentoPermissions[] += $permission->id;
                    break;
                case 'exame-lancar':
                    $gerenteAtendimentoPermissions[] += $permission->id;
                    break;
                case 'exame-resultado':
                    $gerenteAtendimentoPermissions[] += $permission->id;
                    break;

                case 'boletos':
                    $cfcPermissions[] += $permission->id;
                    break;
                case 'boleto-list':
                    $cfcPermissions[] += $permission->id;
                    break;

                case 'credito':
                    $cfcPermissions[] += $permission->id;
                    $financeiroPermissions[] += $permission->id;
                    break;
                case 'credito-list':
                    $cfcPermissions[] += $permission->id;
                    break;
                case 'credito-show':
                    $cfcPermissions[] += $permission->id;
                    break;
                case 'creditosPagos-visualizar':
                    $cfcPermissions[] += $permission->id;
                    $financeiroPermissions[] += $permission->id;
                    break;
                case 'credito-solicitar':
                    $financeiroPermissions[] += $permission->id;
                    break;
                case 'credito-pagar':
                    $financeiroPermissions[] += $permission->id;
                    break;

                case 'transacoes':
                    $caixaPermissions[] += $permission->id;
                    $financeiroPermissions[] += $permission->id;
                    break;
                case 'transacoes-list':
                    $caixaPermissions[] += $permission->id;
                    $financeiroPermissions[] += $permission->id;
                    break;
                case 'transacoes-show':
                    $caixaPermissions[] += $permission->id;
                    $financeiroPermissions[] += $permission->id;
                    break;
                case 'transacoes-create':
                    $caixaPermissions[] += $permission->id;
                    $financeiroPermissions[] += $permission->id;
                    break;

                case 'vendas-create':
                    $atendimentoPermissions[] += $permission->id;
                    $gerenteAtendimentoPermissions[] += $permission->id;
                    break;
                case 'vendas-edit':
                    $gerenteAtendimentoPermissions[] += $permission->id;
                    break;
                case 'vendas-delete':
                    $gerenteAtendimentoPermissions[] += $permission->id;
                    break;
                case 'vendas-reabre-parcela':
                    $gerenteAtendimentoPermissions[] += $permission->id;
                    break;
                case 'vendas-baixa-parcela':
                    $caixaPermissions[] += $permission->id;
                    break;
            }
        }


        Role::create(['name' => 'Admin']);
        $cfcRole = Role::create(['name' => 'Auto Escola']);
        $atendimentoRole = Role::create(['name' => 'Atendimento']);
        $caixaRole = Role::create(['name' => 'Caixa']);
        $gerenteAtendimentoRole = Role::create(['name' => 'Gerente Atendimento']);
        $financeiroRole = Role::create(['name' => 'Financeiro']);

        
        $cfcRole->syncPermissions($cfcPermissions);
        $atendimentoRole->syncPermissions($atendimentoPermissions);
        $caixaRole->syncPermissions($caixaPermissions);
        $gerenteAtendimentoRole->syncPermissions($gerenteAtendimentoPermissions);
        $financeiroRole->syncPermissions($financeiroPermissions);
    }
}
