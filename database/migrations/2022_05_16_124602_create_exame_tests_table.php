10<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExameTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exame_tests', function (Blueprint $table) {
            $table->increments('id');
           
            $table->integer('exame_id')->unsigned();
            $table->foreign('exame_id')->references('id')->on('exames')->onDelete('cascade');

            $table->string('sexo')->nullable();
            $table->string('escolaridade')->nullable();
            $table->string('faixa_etaria')->nullable();
            $table->string('concentrada')->default('A Fazer');
            $table->string('dividida')->default('A Fazer');
            $table->string('alternada')->default('A Fazer');
            $table->string('memoria')->default('A Fazer');
            $table->string('personalidade')->default('A Fazer');
            $table->string('raciocinio')->default('A Fazer');

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
        Schema::dropIfExists('exame_tests');
    }
}
