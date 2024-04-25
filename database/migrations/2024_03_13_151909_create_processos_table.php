<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('processos', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('cfc_id')->unsigned()->nullable();
            $table->integer('aluno_id')->unsigned()->nullable();
            $table->string('categoria')->nullable();
            $table->string('servicos')->nullable();
            $table->string('validade_processo')->nullable();
            $table->string('status')->nullable();
            $table->string('taxas')->nullable();

            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('processos');
    }
};
