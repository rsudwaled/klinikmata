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
            "kode" => "GD",
            "nama" => "Gudang",
            "deskripsi" => "Unit untuk mengeurus gudang obat",
            'pic' => 1,
            'status' => 1,
        ]);
    }
}
