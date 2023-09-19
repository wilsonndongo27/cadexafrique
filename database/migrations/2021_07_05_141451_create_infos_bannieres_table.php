<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfosBannieresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infos_bannieres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('banniere_id');
            $table->string('title');
            $table->string('description');
            $table->string('cover');
            $table->integer('status')->default('1');
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
        Schema::dropIfExists('infos_bannieres');
    }
}
