<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientaccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientaccount', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->dateTime('date_naissance');
            $table->string('sexe');
            $table->bigInteger('telephone');
            $table->string('pays');
            $table->string('adresse');
            $table->string('type_compte');
            $table->string('sous_secteur');
            $table->string('photo_cni_recto');
            $table->string('photo_cni_verso');
            $table->string('plan_localisation');
            $table->string('file_signature')->nullable();
            $table->string('numerique_signature')->nullable();
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
        Schema::dropIfExists('clientaccount');
    }
}
