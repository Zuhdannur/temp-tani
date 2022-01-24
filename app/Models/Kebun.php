<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JenisTanaman;

class Kebun extends Model
{
    use HasFactory;

    protected $table = 'kebun';
    protected $guarded = [];

    public function jenis_tanaman(){
        return $this->hasOne(JenisTanaman::class, 'id', 'id_jenistanaman');
    }

    public function getTotalPopulasiTanamanAttribute($value) {
        $totalBibit = $this->luas_lahan / (($this->jarak_tanam / 100) ** 2);
        return round($totalBibit);
    }

    public function getPerkiraanJumlahHasilPanenAttribute($value) {
        $jumlahPanen = $this->total_populasi_tanaman * $this->harga_satuan_per_hasil_panen;
        return $jumlahPanen;
    }
}
