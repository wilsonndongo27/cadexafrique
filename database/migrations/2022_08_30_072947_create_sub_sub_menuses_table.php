<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubSubMenusesTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('sub_sub_menuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id");
            $table->mediumText("name");
            $table->integer("position");
            $table->integer("status")->default("1");
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
        Schema::dropIfExists('sub_sub_menuses');
    }
}
