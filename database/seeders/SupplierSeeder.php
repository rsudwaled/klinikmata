<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supplier::create([
            "kode" => "PR",
            "nama" => "Nama Perusahaan",
            'alamat' => "Alamat Perusahaan",
            'nohp' => "089529909036",
            'penanggungjawab' => "Penanggungjawab Perusahaan",
            'pic' => 1,
            'status' => 1,
        ]);
    }
}
