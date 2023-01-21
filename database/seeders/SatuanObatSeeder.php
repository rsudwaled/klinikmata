<?php

namespace Database\Seeders;

use App\Models\SatuanObat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SatuanObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SatuanObat::create([
            "kode" => "BTL",
            "nama" => "Botol",
            "deskripsi" => "Satuan botol",
            'status' => 1,
        ]);
        SatuanObat::create([
            "kode" => "TBL",
            "nama" => "Tablet",
            "deskripsi" => "Satuan tablet",
            'status' => 1,
        ]);
        SatuanObat::create([
            "kode" => "KPL",
            "nama" => "Kaplet",
            "deskripsi" => "Satuan kaplet",
            'status' => 1,
        ]);
        SatuanObat::create([
            "kode" => "TB",
            "nama" => "Tube",
            "deskripsi" => "Satuan tube",
            'status' => 1,
        ]);
    }
}
