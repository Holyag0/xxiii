<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoletosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boletos', function (Blueprint $table) {
            $table->id();
            $table->integer('cfc_id')->unsigned();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('venda_id')->unsigned()->nullable();
            $table->string('due_date');
            $table->string('paid_date')->nullable();
            $table->string('transaction_id');
            $table->string('value_cents');
            $table->string('status');
            $table->string('order_id');
            $table->longText('boleto');
            $table->integer('recebido')->nullable();
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
        Schema::dropIfExists('boletos');
    }
}
