<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfosEntreprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infos_entreprises', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id");
            $table->mediumText("name");
            $table->mediumText("contexte");
            $table->longText("activity");
            $table->longText("mission");
            $table->longText("vision");
            $table->longText("objectifs");
            $table->mediumText("adresse1");
            $table->mediumText("adresse2")->nullable();
            $table->mediumText("adresse3")->nullable();
            $table->string("telephone1");
            $table->string("telephone2")->nullable();
            $table->string("telephone3")->nullable();
            $table->longText("mapLink");
            $table->string("logo");
            $table->string("cover")->nullable();
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
        Schema::dropIfExists('infos_entreprises');
    }
}
