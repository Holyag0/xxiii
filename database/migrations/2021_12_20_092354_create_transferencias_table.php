<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transferencias', function (Blueprint $table) {
            $table->id();
            $table->string('obs')->nullable();
            $table->string('valor');
            $table->string('data_transferencia');

            $table->integer('conta_origem')->unsigned();
            $table->foreign('conta_origem')->references('id')->on('contas_digitais');

            $table->integer('conta_destino')->unsigned();
            $table->foreign('conta_destino')->references('id')->on('contas_digitais');

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
        Schema::dropIfExists('transferencias');
    }
}
