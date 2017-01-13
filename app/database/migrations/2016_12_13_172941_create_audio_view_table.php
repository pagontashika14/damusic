<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAudioViewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audio_views', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('audio_id');
            $table->string('unique_string',500);
            $table->timestamps();
        });

        Schema::table('audio_views', function(Blueprint $table) {
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
        Schema::dropIfExists('audio_views');
    }
}
