<?php

namespace App\Imports;

use App\Models\Obat;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ObatImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $obat_count = Obat::count();
        $kode = 'OB' . str_pad($obat_count + 1, 4, '0', STR_PAD_LEFT);
        return new Obat([
            'kode' => $kode,
            'nama' => $row['nama'],
            'status' => 1,
            'pic' => 1,
        ]);
    }
}
