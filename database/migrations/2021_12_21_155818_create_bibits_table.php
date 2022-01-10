<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBibitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bibit', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_jenis_tanaman');
            $table->string('wujud_produksi');
            $table->string('satuan_bibit');
            $table->integer('harga_bibit');
            $table->date('tanggal_update');
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
        Schema::dropIfExists('bibit');
    }
}
