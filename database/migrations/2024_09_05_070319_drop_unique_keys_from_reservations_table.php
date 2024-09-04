<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropUniqueKeysFromReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
             // UNIQUE KEY `reservations_schedule_id_sheet_id_unique` を削除
             $table->dropUnique('reservations_schedule_id_sheet_id_unique');

             // UNIQUE KEY `reservations_screen_id_sheet_id_unique` を削除
             $table->dropUnique('reservations_screen_id_sheet_id_unique');
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
            // UNIQUE KEY `reservations_schedule_id_sheet_id_unique` を復元
            $table->unique(['schedule_id', 'sheet_id'], 'reservations_schedule_id_sheet_id_unique');

            // UNIQUE KEY `reservations_screen_id_sheet_id_unique` を復元
            $table->unique(['screen_id', 'sheet_id'], 'reservations_screen_id_sheet_id_unique');
        });
    }
}
