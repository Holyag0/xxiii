<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transacoes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('data_pagamento');
            $table->string('tipo');
            $table->string('forma_pagamento');
            $table->string('valor');
            $table->string('favorecido')->nullable();
            $table->integer('aluno_id')->unsigned()->nullable();
            $table->string('descricao')->nullable();
            $table->string('user_id')->nullable();

            $table->integer('cfc_id')->unsigned();
            $table->foreign('cfc_id')->references('id')->on('cfcs');

            $table->integer('conta_id')->unsigned();
            $table->foreign('conta_id')->references('id')->on('contas_digitais');

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
        Schema::dropIfExists('transacoes');
    }
}
