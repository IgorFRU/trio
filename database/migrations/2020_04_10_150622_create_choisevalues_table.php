<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChoisevaluesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('choisevalues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('choise_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->string('value', 250);
            $table->string('color', 30)->nullable();
            $table->string('thumbnail', 250)->nullable();
            $table->string('image', 250)->nullable();
            $table->unsignedDecimal('price', 8, 2)->nullable()->default(0);
            $table->enum('price_type', ['original', '+', '-'])->nullable()->default('original');
            $table->bigInteger('discount_id')->nullable()->unsigned();      
            $table->timestamps();

            $table->foreign('discount_id')
                ->references('id')
                ->on('discounts')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('choise_id')
                ->references('id')
                ->on('choises')
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
        Schema::dropIfExists('choisevalue');
    }
}
