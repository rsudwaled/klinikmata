<?php

namespace App\Imports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BarangImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $kode = 'B' . str_pad(Barang::count() + 1, 6, '0', STR_PAD_LEFT);
        return new Barang([
            'kode' => $kode,
            'nama' => $row['nama'],
            'pic' => 1,
        ]);
    }
}
