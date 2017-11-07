<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('age');
            $table->string('sex');
            $table->string('job');
            $table->smallInteger('str');
            $table->smallInteger('con');
            $table->smallInteger('dex');
            $table->smallInteger('pow');
            $table->smallInteger('app');
            $table->smallInteger('siz');
            $table->smallInteger('int');
            $table->smallInteger('edu');
            $table->smallInteger('hp');
            $table->smallInteger('mp');
            $table->smallInteger('san');
            $table->string('comment');
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
        Schema::dropIfExists('characters');
    }
}
