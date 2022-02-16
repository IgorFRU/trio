<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('summ_start')->unsigned()->nullable();
            $table->integer('summ_end')->unsigned()->nullable();
            $table->integer('mass_start')->unsigned()->nullable();
            $table->integer('mass_end')->unsigned()->nullable();
            $table->integer('price')->unsigned()->nullable();
            $table->string('description', 191)->nullable();
            $table->tinyInteger('priority')->unsigned()->nullable();
            $table->bigInteger('deliverycategory_id')->nullable()->unsigned();
            $table->timestamps();

            $table->foreign('deliverycategory_id')
                ->references('id')
                ->on('deliverycategories')
                ->onDelete('set null')
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
        Schema::dropIfExists('deliveries');
    }
}
