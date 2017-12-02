<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('Speed');
            $table->string('passing');
            $table->string('Shooting');
            $table->string('Teamwork');
            $table->string('Defence');
            $table->string('Stamina');
            $table->string('Keeper');
            $table->string('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('player');
    }
}
