<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('authorizationcode')->nullable(true);
            $table->text('payment')->nullable(true);
            $table->text('approved')->nullable(true);
            $table->text('ammount');
            //$table->text('comercecode')->nullable(true);;
            $table->text('buyorder');
            $table->text('transactiontoken');
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
        Schema::dropIfExists('transactions');
    }
}
