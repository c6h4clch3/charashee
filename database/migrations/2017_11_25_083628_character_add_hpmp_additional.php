<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CharacterAddHpmpAdditional extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coc_characters', function(Blueprint $table) {
            $table->smallinteger('hp_additional')->unsigned()->default(0);
            $table->smallinteger('mp_additional')->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coc_characters', function(Blueprint $table) {
            $table->dropColumn('hp_additional');
            $table->dropColumn('mp_additional');
        });
    }
}
