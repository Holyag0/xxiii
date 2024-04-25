<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlunoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('clinica_id')->unsigned()->nullable();
            $table->integer('credito_cfc_id')->nullable();
            $table->integer('cfc_id')->unsigned()->nullable();
            $table->integer('avulso_id')->unsigned()->nullable();
            $table->integer('processo_id')->unsigned()->nullable();

            
            $table->string('nome');
            $table->string('cpf');
            $table->string('rg')->nullable();
            $table->string('escolaridade')->nullable();
            $table->string('date_nasc')->nullable();
            $table->string('estado_civil')->nullable();
            $table->string('email')->nullable();
            $table->string('cnh')->nullable();
            $table->string('tipo')->default('Normal');
            $table->string('pai')->nullable();
            $table->string('mae')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->string('pais')->nullable();
            $table->string('logradouro')->nullable();
            $table->string('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cep')->nullable();
            $table->string('fone')->nullable();
            $table->string('celular')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alunos');
    }
}
