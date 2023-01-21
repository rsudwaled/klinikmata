<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::create([
            "kode" => "GDO",
            "nama" => "Gudang Obat",
            "deskripsi" => "Unit untuk mengurus gudang obat",
            'pic' => 1,
            'status' => 1,
        ]);
        Unit::create([
            "kode" => "APT",
            "nama" => "Apotek",
            "deskripsi" => "Unit untuk memberikan obat kepada pasien",
            'pic' => 1,
            'status' => 1,
        ]);
        Unit::create([
            "kode" => "DFT",
            "nama" => "Pendaftaran",
            "deskripsi" => "Unit untuk mendaftarkan pasien",
            'pic' => 1,
            'status' => 1,
        ]);
        Unit::create([
            "kode" => "PRD",
            "nama" => "Pemeriksaan Dokter",
            "deskripsi" => "Unit untuk mendaftarkan pasien",
            'pic' => 1,
            'status' => 1,
        ]);
        Unit::create([
            "kode" => "PRP",
            "nama" => "Pemeriksaan Perawat",
            "deskripsi" => "Unit untuk mendaftarkan pasien",
            'pic' => 1,
            'status' => 1,
        ]);
    }
}
