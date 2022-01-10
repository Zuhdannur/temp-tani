<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultToKebun extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kebun', function (Blueprint $table) {
            $table->dropColumn('total_jumlah_populasi_tanaman');
            $table->integer('total_populasi_tanaman')->default(0)->change();
            $table->integer('perkiraan_jumlah_hasil_panen')->default(0)->change();
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
            $table->integer('total_jumlah_populasi_tanaman')->default(0);
            $table->integer('total_populasi_tanaman')->default(0)->change();
            $table->integer('perkiraan_jumlah_hasil_panen')->default(0)->change();
        });
    }
}
