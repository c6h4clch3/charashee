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
        Schema::create('coc_characters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('name');
            $table->integer('age')->unsigned();
            $table->string('sex');
            $table->string('job');
            $table->smallInteger('str')->unsigned();
            $table->smallInteger('con')->unsigned();
            $table->smallInteger('dex')->unsigned();
            $table->smallInteger('pow')->unsigned();
            $table->smallInteger('app')->unsigned();
            $table->smallInteger('siz')->unsigned();
            $table->smallInteger('int')->unsigned();
            $table->smallInteger('edu')->unsigned();
            $table->smallInteger('hp')->unsigned();
            $table->smallInteger('mp')->unsigned();
            $table->smallInteger('san')->unsigned();
            $table->string('comment');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('coc_characters');
    }
}
