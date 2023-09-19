<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignID('user_id');
            $table->foreignID('customer_id');
            $table->string('message');
            $table->string('message_rep');
            $table->integer('client_read')->default('0');
            $table->integer('customer_read')->default('0');
            $table->integer('client_rep')->default('0');
            $table->integer('customer_rep')->default('0');
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
        Schema::dropIfExists('chat_messages');
    }
}
