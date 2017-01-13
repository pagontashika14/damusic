<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAudioTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audio_type', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('audio_id');
            $table->integer('type_id');
        });

        Schema::table('audio_type', function(Blueprint $table) {
            $table->foreign('audio_id')->references('id')->on('audio');
            $table->foreign('type_id')->references('id')->on('types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audio_type');
    }
}
