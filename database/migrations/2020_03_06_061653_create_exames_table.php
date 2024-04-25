<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exames', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cfc_id')->unsigned();    
            $table->integer('venda_id')->unsigned();
            $table->string('profissional_id')->nullable();   
            $table->string('data_exame')->nullable();
            $table->string('turno')->nullable();
            $table->string('status')->nullable()->default('A Fazer');
            $table->string('tipo')->nullable();
            
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
        Schema::dropIfExists('exames');
    }
}
