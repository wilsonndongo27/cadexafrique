<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_detail_models', function (Blueprint $table) {
            $table->id();
            $table->foreignId("creator");
            $table->foreignId("menu_id");
            $table->mediumText("title");
            $table->mediumText("libelle");
            $table->longText("description");
            $table->string("image");
            $table->longText("freetext1")->nullable();
            $table->longText("freetext2")->nullable();
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
        Schema::dropIfExists('order_detail_models');
    }
}
