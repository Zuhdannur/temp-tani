<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemAnggaran extends Model
{
    use HasFactory;
    protected $table = 'sub_kategori';
    protected $guarded = [];

    public function barang() {
        return $this->hasMany(Barang::class, 'id_sub_kategori', 'id');
    }

    public function getTotalBiayaSubKategoriAttribute() {
        return (int)\App\Models\Barang::where('id_sub_kategori', $this->id)->sum('jumlah_biaya');
    }
}
