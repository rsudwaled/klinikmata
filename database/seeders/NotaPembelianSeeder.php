<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\NotaPembelian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotaPembelianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $obats = Barang::get();
        foreach ($obats as $value) {
            $data = [
                "supplier_id" => 1,
                "tanggal_faktur" => fake()->date(),
                "kode" => fake()->numerify('GD####'),
                "nomor_faktur" => fake()->numerify('######'),
                "barang_id" => $value->id,
                "jumlah" => fake()->numerify('100'),
                "harga_beli" =>  fake()->numerify('1#00000'),
                "pic" =>  1,
            ];
            NotaPembelian::create($data);
        }
    }
}
