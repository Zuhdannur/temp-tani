<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisTanaman;

class JenisTanamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nama_jenistanaman' => 'Padi',
                'harga_jual' => 10000
            ],
            [
                'nama_jenistanaman' => 'Jagung',
                'harga_jual' => 8000
            ],
            [
                'nama_jenistanaman' => 'Ubi',
                'harga_jual' => 9000
            ],
        ];

        JenisTanaman::insert($data);
    }
}
