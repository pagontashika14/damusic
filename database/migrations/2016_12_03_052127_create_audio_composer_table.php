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
            $table->integer('audio_id');
            $table->integer('singer_id');
            $table->unique(['audio_id']);
        });

        Schema::table('audio_composer', function(Blueprint $table) {
            $table->foreign('audio_id')->references('id')->on('audio');
            $table->foreign('singer_id')->references('id')->on('singers');
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
