<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicosAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicos_alunos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('servico_id')->unsigned();
            $table->foreign('servico_id')->references('id')->on('servicos');

            $table->integer('aluno_id')->unsigned();
            $table->foreign('aluno_id')->references('id')->on('alunos');

            $table->string('tipo_processo')->nullable();
            $table->string('status')->nullable();
            $table->string('data_remarcacao')->nullable();
            $table->string('data_exame')->nullable();
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
        Schema::dropIfExists('servicos_alunos');
    }
}
