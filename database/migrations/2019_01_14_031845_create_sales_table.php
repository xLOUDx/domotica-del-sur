<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('payment');
            $table->string('amount');
            $table->string('buyorder');
            $table->string('client');
            $table->string('client_lastname');
            $table->string('rutclient');
            $table->string('seller');
            $table->string('company')->nullable(true);
            $table->string('rutcompany')->nullable(true);
            $table->string('discount')->nullable(true);
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
        Schema::dropIfExists('sales');
    }
}
