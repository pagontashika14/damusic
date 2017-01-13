<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAudioUserLikeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audio_user_like', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('audio_id');
        });

        Schema::table('audio_user_like', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('audio_id')->references('id')->on('audio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audio_user_like');
    }
}
