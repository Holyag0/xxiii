<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstrutoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instrutores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cfc_id')->unsigned()->nullable();
            
            $table->string('nome');
            $table->string('email');
            $table->string('cpf')->unique();
            $table->string('data_nascimento');
            
            $table->string('categoria');
            $table->string('venc_cnh');
            $table->string('venc_ci');
            $table->string('n_registro_cnh');
            
            $table->string('inicio_ferias')->nullable();
            $table->string('fim_ferias')->nullable();

            $table->string('portal');

            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->string('pais')->nullable();
            $table->string('logradouro')->nullable();
            $table->string('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cep')->nullable();
            $table->string('cel');

            $table->string('valor_hora_extra')->nullable();
            $table->string('valor_aula_extra')->nullable();
            $table->string('valor_produtividade')->nullable();

            $table->string('saida_almoco');
            $table->string('retorno_almoco');

            $table->string('status');
            
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
        Schema::dropIfExists('instrutores');
    }
}
