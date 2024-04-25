<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParcelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcelas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('venda_id')->unsigned()->nullable();
            $table->integer('transacao_id')->unsigned()->nullable();
            $table->foreign('venda_id')->references('id')->on('vendas')->onDelete('cascade');
            $table->integer('cfc_id')->unsigned()->nullable();

            $table->string('valor_parcela')->nullable();
            $table->string('desconto')->nullable();
            $table->string('status')->default(0);
            $table->string('data_pagamento')->nullable();
            $table->string('forma_pagamento')->nullable();
            $table->string('quantidade_parcelas')->nullable();


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
        Schema::dropIfExists('parcelas');
    }
}