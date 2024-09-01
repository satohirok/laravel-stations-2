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
            // 既存のユニーク制約を削除
            $table->dropUnique(['schedule_id', 'sheet_id']);

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
            // 新しいユニーク制約を削除
            $table->dropUnique(['schedule_id', 'sheet_id', 'screen_id']);

            // 既存のユニーク制約を追加
            $table->unique(['schedule_id', 'sheet_id']);
        });
    }
}
