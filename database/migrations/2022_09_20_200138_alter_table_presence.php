<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTablePresence extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('presences', function (Blueprint $table) {
            $table->dropColumn('date');
            $table->dateTime('check_in');
            $table->integer('schedule_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('presences', function (Blueprint $table) {
            $table->date('date');
            $table->dropColumn('check_in');
            $table->dropColumn('schedule_id');
        });
    }
}
