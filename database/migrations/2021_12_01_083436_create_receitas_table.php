<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receitas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('valor')->default(0);
            $table->string('data_vencimento');
            $table->string('data_pagamento')->nullable();
            $table->string('obs')->nullable();
            $table->string('anexo')->nullable();
            $table->string('status')->default(0);

            $table->integer('cfc_id')->unsigned();
            $table->foreign('cfc_id')->references('id')->on('cfcs');

            $table->integer('categoria_id')->unsigned()->nullable();
            $table->foreign('categoria_id')->references('id')->on('categorias');

            $table->integer('aluno_id')->unsigned()->nullable();
            $table->integer('parcela_id')->unsigned()->nullable();
            $table->integer('auto_escola_id')->unsigned()->nullable();
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
        Schema::dropIfExists('receitas');
    }
}
