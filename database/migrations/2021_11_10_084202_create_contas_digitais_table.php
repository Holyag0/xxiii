<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContasDigitaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contas_digitais', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cfc_id')->unsigned();
            $table->string('nome')->unique();
            $table->string('saldo_inicial')->default(0);
            $table->string('saldo_atual')->nullable();
            $table->string('data_abertura');
            $table->string('status')->default(1);
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
        Schema::dropIfExists('contas');
    }
}
