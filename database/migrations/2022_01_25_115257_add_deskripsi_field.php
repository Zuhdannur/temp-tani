<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeskripsiField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kategori', function (Blueprint $table) {
            $table->text("deskripsi")->nullable();
        });

        Schema::table('sub_kategori', function (Blueprint $table) {
            $table->text("deskripsi")->nullable();
        });

        Schema::table('barang', function (Blueprint $table) {
            $table->text("deskripsi")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kategori', function (Blueprint $table) {
            $table->dropColumn("deskripsi");
        });

        Schema::table('sub_kategori', function (Blueprint $table) {
            $table->dropColumn("deskripsi");
        });

        Schema::table('barang', function (Blueprint $table) {
            $table->dropColumn("deskripsi");
        });
    }
}
