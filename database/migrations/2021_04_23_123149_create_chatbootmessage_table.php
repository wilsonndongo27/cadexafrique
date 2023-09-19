<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatbootmessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chatbootmessage', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user')->nullable();
            $table->string('content')->nullable();
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->string('rep_message')->nullable();
            $table->string('owner_resp')->nullable();
            $table->string('is_read')->default('0');
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
        Schema::dropIfExists('chatbootmessage');
    }
}
