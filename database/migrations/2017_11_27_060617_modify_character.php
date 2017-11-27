<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyCharacter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coc_characters', function(Blueprint $table) {
            $table->smallinteger('hp_additional')->default(0)->change();
            $table->smallinteger('mp_additional')->default(0)->change();
            $table->smallinteger('mythos_skill')->default(0);
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
            $table->smallinteger('hp_additional')->unsigned()->default(0)->change();
            $table->smallinteger('mp_additional')->unsigned()->default(0)->change();
            $table->dropColumn('mythos_skill');
        });
    }
}
