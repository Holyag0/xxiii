<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFornecedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome',150)->unique();
            $table->integer('cfc_id')->unsigned();
            $table->string('cpfCnpj')->unique()->nullable();
            $table->string('email',150)->unique();
            $table->string('telefone')->nullable();
            $table->string('celular');
            $table->string('cep');
            $table->string('logradouro');
            $table->string('numero');
            $table->string('estado');
            $table->string('cidade');
            $table->string('complemento')->nullable();
            $table->string('bairro');
            $table->longText('obs')->nullable();
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
        Schema::dropIfExists('fornecedores');
    }
}
