<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateReservationsTableUniqueConstraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('reservations', function (Blueprint $table) {
            // 新しいユニーク制約を追加
            $table->unique(['schedule_id', 'sheet_id', 'screen_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('reservations', function (Blueprint $table) {
            $table->unique(['schedule_id', 'sheet_id'], 'reservations_schedule_id_sheet_id_unique');


            $table->unique(['screen_id', 'sheet_id'], 'reservations_screen_id_sheet_id_unique');
        });
    }
}
