<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddScreenIdToReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            //

            $table->unsignedBigInteger('screen_id')->after('sheet_id');

            $table->foreign('screen_id')->references('id')->on('screens');
            $table->index('screen_id');

            $table->unique(['screen_id','sheet_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            //
        });
    }
}
