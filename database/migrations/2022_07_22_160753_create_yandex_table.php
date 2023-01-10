<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYandexTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yandex', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('only_published_products')->nullable()->default(true);
            $table->int('description_length')->nullable()->default(3000);
            $table->json('category_ids')->nullable();
            $table->boolean('only_categories')->nullable()->default(true);
            $table->json('manufacture_ids')->nullable();
            $table->boolean('only_manufactureses')->nullable()->default(true);
            $table->json('products_ids')->nullable();
            $table->boolean('only_products')->nullable()->default(true);
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
        Schema::dropIfExists('yandex');
    }
}
