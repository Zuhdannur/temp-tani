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
}
