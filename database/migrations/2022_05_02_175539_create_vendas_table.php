<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->integer('aluno_id')->unsigned()->nullable();
            $table->foreign('aluno_id')->references('id')->on('alunos')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('cfc_id')->unsigned();
            $table->integer('pacote_id')->unsigned()->nullable();
            $table->increments('id');
            $table->string('nome')->nullable();
            $table->string('valor_venda')->nullable()->default(0);
            $table->string('valor_pago')->nullable()->default(0);
            $table->string('desconto')->nullable()->default(0);
            $table->string('status')->nullable();
            $table->string('data_venda')->nullable();
            $table->string('forma_pagamento')->nullable();     

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
        Schema::dropIfExists('vendas');
    }
}
