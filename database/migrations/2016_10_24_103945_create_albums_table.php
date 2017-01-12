<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code',60)->unique();
            $table->string('name');
            $table->integer('singer_id');
            $table->integer('image_id')->nullable();
            $table->text('description')->nullable();
        });

        Schema::table('albums', function(Blueprint $table) {
            $table->foreign('singer_id')->references('id')->on('singers');
            $table->foreign('image_id')->references('id')->on('images');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('albums');
    }
}
