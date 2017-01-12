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
            $table->integer('audio_id');
            $table->integer('playlist_id');
            $table->timestamp('create_time');
            $table->unique(['audio_id', 'playlist_id']);
        });

        Schema::table('audio_playlist', function(Blueprint $table) {
            $table->foreign('audio_id')->references('id')->on('audio');
            $table->foreign('playlist_id')->references('id')->on('playlists');
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
