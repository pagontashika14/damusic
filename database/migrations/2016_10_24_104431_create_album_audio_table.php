<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumAudioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('album_audio', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('album_id')->references('id')->on('albums');
            $table->integer('audio_id')->references('id')->on('audio');
            $table->timestamp('create_time');
            $table->unique(['album_id','audio_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('album_audio');
    }
}
