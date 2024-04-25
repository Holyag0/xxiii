<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('venda_servicos', function (Blueprint $table) {
            $table->id();
            $table->integer('venda_id')->unsigned()->nullable();
            $table->foreign('venda_id')->references('id')->on('vendas')->onDelete('cascade');
            $table->integer('cfc_id')->unsigned()->nullable();

            $table->string('nome')->nullable();
            $table->string('valor')->nullable();
            $table->string('desconto')->nullable();
            $table->string('quantidade')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('venda_servicos');
    }
};
