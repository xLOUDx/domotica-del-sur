<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('model');
            $table->text('description');
            $table->text('data_sheet');
            $table->integer('price');
            $table->integer('stock');
            $table->string('internal_code');
            $table->string('type');
            $table->string('img1');
            $table->string('img2')->nullable(true);
            $table->string('img3')->nullable(true);
            $table->string('img4')->nullable(true);
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
        Schema::dropIfExists('products');
    }
}
