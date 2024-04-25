<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditoCfcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credito_cfc', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cfc_id')->unsigned()->nullable();
            $table->integer('aluno_id')->unsigned()->nullable();
            $table->integer('boleto_id')->unsigned()->nullable();

            $table->string('valor_pacote')->nullable();
            $table->string('valor_credito')->nullable();
            $table->string('status')->default(0);
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
        Schema::dropIfExists('credito_cfc');
    }
}
