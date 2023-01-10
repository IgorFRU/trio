<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductdifferentvaluesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productdifferentvalues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('value', 190);
            $table->bigInteger('productdifferent_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('image_id')->unsigned();

            $table->foreign('productdifferent_id')
                ->references('id')
                ->on('productdifferents')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('image_id')
                ->references('id')
                ->on('images')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productdifferentvalues');
    }
}
