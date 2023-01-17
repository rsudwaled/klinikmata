<?php

namespace Database\Seeders;

use App\Models\Poliklinik;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PoliklinikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Poliklinik::create([
            "kodepoli" => "MAT",
            "namapoli" => "MATA",
            "kodesubspesialis" => "MAT",
            "namasubspesialis" => "MATA",
            'status' => 1,
        ]);
        Poliklinik::create([
            "kodepoli" => "THT",
            "namapoli" => "TELINGA TENGGOROKAN",
            "kodesubspesialis" => "THT",
            "namasubspesialis" => "TELINGA HIDUNG TENGGOROKAN",
            'status' => 0,
        ]);
    }
}
