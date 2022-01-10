<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKebunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kebun', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->unsignedInteger('id_jenistanaman')->nullable();
            $table->string('nama_kebun', 30);
            $table->string('provinsi', 25);
            $table->string('kota', 35);
            $table->string('kecamatan', 40);
            $table->string('desa', 30);
            $table->integer('luas_lahan');
            $table->integer('jarak_tanam');
            $table->integer('hasil_panen_per_ubin');
            $table->integer('total_populasi_tanaman');
            $table->integer('perkiraan_jumlah_hasil_panen');
            $table->integer('harga_satuan_per_hasil_panen');
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
        Schema::dropIfExists('kebun');
    }
}
