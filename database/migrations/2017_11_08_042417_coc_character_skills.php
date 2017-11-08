<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CocCharacterSkills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coc_character_skills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('character_id')->unsigned();
            $table->integer('skill_id')->unsigned();
            $table->smallInteger('job_point')->unsigned();
            $table->smallInteger('interest_point')->unsigned();
            $table->smallInteger('others_point');
            $table->foreign('character_id')->references('id')->on('coc_characters')->onDelete('cascade');
            $table->foreign('skill_id')->references('id')->on('coc_skills')->onDelete('cascade');
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
        Schema::dropIfExists('coc_character_skills');
    }
}
