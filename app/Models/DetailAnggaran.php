<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAnggaran extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $guarded = [];

    public function item_anggaran() {
        return $this->hasMany(ItemAnggaran::class, 'id_kategori', 'id');
    }

    public function getTotalBiayaKategoriAttribute() {
        $rows = \App\Models\ItemAnggaran::where('id_kategori', $this->id)->get();
        $total = 0;
        foreach($rows as $row) {
            $total += $row->total_biaya_sub_kategori;
        }
        return $total;
    }
}
