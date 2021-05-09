<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJemaatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jemaats', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("placeofbirth");
            $table->string("dateofbirth");
            $table->string("gender");
            $table->string("status")->nullable();
            $table->string("address")->nullable();
            $table->string("phone")->nullable();
            $table->string("avatar")->nullable();
            $table->string("pelkat")->nullable();
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
        Schema::dropIfExists('jemaats');
    }
}
