<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggaran extends Model
{
    use HasFactory;
    protected $table = 'anggaran';
    protected $guarded = [];

    public function detail_anggaran() {
        return $this->hasMany(DetailAnggaran::class, 'id_anggaran', 'id');
    }
    
    public function getTotalBiayaKeseluruhanAttribute() {
        $rows = \App\Models\DetailAnggaran::where('id_anggaran', $this->id)->get();
        $total = 0;
        foreach($rows as $row) {
            $total += $row->total_biaya_kategori;
        }
        return $total;
    }
}
