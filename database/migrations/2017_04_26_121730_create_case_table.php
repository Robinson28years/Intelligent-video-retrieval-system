<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lawcase', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('video', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->double('lng');
            $table->double('lat');
            $table->dateTime('start');
            $table->string('label');
            $table->string('status');
            $table->integer('lawcase_id')->unsigned();
            $table->foreign('lawcase_id')
                ->references('id')
                ->on('lawcase')
                ->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('smallvideo', function (Blueprint $table) {
            $table->increments('id');
            $table->time('start');
            $table->time('end');
            $table->integer('video_id')->unsigned();
            $table->foreign('video_id')
                ->references('id')
                ->on('video')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table');
    }
}
