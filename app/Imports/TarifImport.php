<?php

namespace App\Imports;

use App\Models\Tarif;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TarifImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        $tarif_count = Tarif::count();
        $kode = 'TR' . str_pad($tarif_count + 1, 4, '0', STR_PAD_LEFT);
        return new Tarif([
            'kode' => $kode,
            'nama' => $row['nama'],
            'harga' => $row['harga'],
            'jenis' => $row['jenis'],
            'pic' => 1,
        ]);
    }
}
