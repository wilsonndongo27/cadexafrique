<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id");
            $table->mediumText("first_name");
            $table->mediumText("last_name");
            $table->string("telephone");
            $table->longText("adresse");
            $table->longText("email");
            $table->string("photo");
            $table->string("signature")->nullable();
            $table->integer("poste");
            $table->integer("status")->default("1");
            $table->longText("freetext1")->nullable();
            $table->longText("freetext2")->nullable();
            $table->longText("freetext3")->nullable();
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
        Schema::dropIfExists('staff_infos');
    }
}
