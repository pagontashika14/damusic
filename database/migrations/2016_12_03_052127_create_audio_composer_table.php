<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAudioComposerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audio_composer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('audio_id')->references('id')->on('audio');
            $table->integer('singer_id')->references('id')->on('singers');
            $table->unique(['audio_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audio_composer');
    }
}
