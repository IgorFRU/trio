<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParentProductIdColumtToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('parentproduct_id')->default(0)->nullable();
            // $table->unsignedBigInteger('differensetype_id')->nullable();
            $table->string('differensevalue')->nullable();
            $table->string('differenseimage')->nullable();


            // $table->foreign('differensetype_id')
            //     ->references('id')
            //     ->on('productdifferensetypes')
            //     ->onDelete('cascade')
            //     ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
