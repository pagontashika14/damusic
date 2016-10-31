<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAudioPlaylistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audio_playlist', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('audio_id')->references('id')->on('audio');
            $table->integer('playlist_id')->references('id')->on('playlists');
            $table->timestamp('create_time');
            $table->unique(['audio_id', 'playlist_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audio_playlist');
    }
}
