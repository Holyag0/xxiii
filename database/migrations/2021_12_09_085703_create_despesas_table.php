<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDespesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('despesas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('valor');
            $table->string('data_vencimento');
            $table->string('data_pagamento')->nullable();
            $table->string('obs')->nullable();
            $table->string('anexo')->nullable();
            $table->string('status')->default(0);

            $table->integer('cfc_id')->unsigned();
            $table->foreign('cfc_id')->references('id')->on('cfcs');

            $table->integer('centro_custo_id')->unsigned();
            $table->foreign('centro_custo_id')->references('id')->on('centro_custos');

            $table->integer('fornecedor_id')->unsigned();
            $table->foreign('fornecedor_id')->references('id')->on('fornecedores');

            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('transacao_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('despesas');
    }
}
