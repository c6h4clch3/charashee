<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCocSkillsetSkills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coc_skillset_skills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('skillset_id')->unsigned();
            $table->integer('skill_id')->unsigned();
            $table->boolean('is_option');
            $table->foreign('skillset_id')->references('id')->on('coc_skillsets')->onDelete('cascade');
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
        Schema::dropIfExists('coc_skillset_skills');
    }
}
