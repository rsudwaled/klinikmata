<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\NotaPembelian;
use App\Models\NotaPenjualan;
use App\Models\Stok;
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
            $notabeli = [
                "supplier_id" => 1,
                "tanggal_faktur" => fake()->date(),
                "kode" => "NPB" . now()->format('dm') . str_pad(NotaPembelian::whereDate('created_at', now()->today())->count() + 1, 4, '0', STR_PAD_LEFT),
                "nomor_faktur" => fake()->numerify('######'),
                "barang_id" => $value->id,
                "jumlah" => 100,
                "harga_beli" => fake()->numerify('1#00000'),
                "pic" => 1,
            ];
            NotaPembelian::create($notabeli);
            $notabeli["stok_in"] = 100;
            $notabeli["stok_current"] = 100;
            Stok::create($notabeli);
            $stok = $value->stok_current;
            $value->update([
                "stok_current" => $stok + 100
            ]);
        }
        for ($i = 1; $i < 21; $i++) {
            $jumlah = fake()->numerify('1#');
            $id = fake()->numerify('1#');
            $notajual = [
                "pasien_id" => $i,
                "tanggal_faktur" => fake()->date(),
                "nomor_faktur" => fake()->numerify('######'),
                "barang_id" => $id,
                "jumlah" => $jumlah,
                "harga_jual" => fake()->numerify('1#000'),
                "pic" => 1,
                "kode" => "NPJ" . now()->format('dm') . str_pad(NotaPenjualan::whereDate('created_at', now()->today())->count() + 1, 4, '0', STR_PAD_LEFT),
            ];
            NotaPenjualan::create($notajual);
            $obat = Barang::find($id);
            $stok = $obat->stok_current;
            $obat->update([
                "stok_current" => $stok - $jumlah
            ]);
            $notajual["stok_out"] = $jumlah;
            $notajual["stok_current"] = $stok - $jumlah;
            Stok::create($notajual);
        }
    }
}
