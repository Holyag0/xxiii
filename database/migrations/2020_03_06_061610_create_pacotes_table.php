<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacotes', function (Blueprint $table) {
            $table->id();
            $table->integer('cfc_id')->unsigned();
            $table->integer('processo_id')->unsigned()->nullable();

            $table->string('nome');
            $table->string('categoria');
            $table->string('desconto_boleto')->nullable();
            $table->string('valor_credito')->nullable();
            $table->string('status')->default('1');
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
        Schema::dropIfExists('pacotes');
    }
}
