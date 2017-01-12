<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAudioLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audio_links', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('audio_id');
            $table->string('name',500)->unique();
        });

        Schema::table('audio_links', function(Blueprint $table) {
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
        Schema::dropIfExists('audio_links');
    }
}
