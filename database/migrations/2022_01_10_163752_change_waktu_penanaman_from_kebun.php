<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeWaktuPenanamanFromKebun extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kebun', function (Blueprint $table) {
            $table->integer('waktu_penanaman')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kebun', function (Blueprint $table) {
            $table->string('waktu_penanaman')->change();
        });
    }
}
