<?php

namespace Database\Seeders;

use App\Models\Ruangan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ruangan::create([
            "nama" => "Periksa 1",
            "deskripsi" => "Ruangan periksa pertama code A",
            "lokasi" => "A",
            "lantai" => "1",
            'status' => 1,
        ]);
        Ruangan::create([
            "nama" => "Periksa 2",
            "deskripsi" => "Ruangan periksa pertama code B",
            "lokasi" => "B",
            "lantai" => "1",
            'status' => 1,
        ]);
        Ruangan::create([
            "nama" => "Pendaftaran",
            "deskripsi" => "Ruangan pendaftaran pasien",
            "lokasi" => "A",
            "lantai" => "1",
            'status' => 1,
        ]);
        Ruangan::create([
            "nama" => "Ruangan Perawatan",
            "deskripsi" => "Ruangan istirahat perawat",
            "lokasi" => "A",
            "lantai" => "1",
            'status' => 0,
        ]);
    }
}
