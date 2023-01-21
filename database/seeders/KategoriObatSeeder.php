<?php

namespace Database\Seeders;

use App\Models\KategoriObat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KategoriObat::create([
            "kode" => "OBUM",
            "nama" => "Obat Umum",
            "deskripsi" => "Obat untuk pasien umum",
            'status' => 1,
        ]);
        KategoriObat::create([
            "kode" => "OBPJS",
            "nama" => "Obat BPJS",
            "deskripsi" => "Obat untuk pasien bpjs",
            'status' => 1,
        ]);
    }
}
