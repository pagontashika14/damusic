<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSingersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('singers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('stage_name');
            $table->string('name')->nullable();
            $table->string('birthday')->nullable();
            $table->integer('nation_id');
            $table->integer('image_id')->nullable();
            $table->text('description')->nullable();
        });

        Schema::table('singers', function(Blueprint $table) {
            $table->foreign('nation_id')->references('id')->on('nations');
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
        Schema::dropIfExists('singers');
    }
}
