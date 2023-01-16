<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Indonesia\Models\Kabupaten;
use Laravolt\Indonesia\Models\Kecamatan;
use Laravolt\Indonesia\Models\Provinsi;
use Laravolt\Indonesia\Models\Village;

class Pasien extends Model
{
    use HasFactory;


    protected $appends = [
        'nama_provinsi',
        'nama_kabupaten',
        'nama_kecamatan',
        'nama_desa',
    ];

    public function getNamaProvinsiAttribute()
    {
        $item = Provinsi::where('code', $this->provinsi)->first();
        return $item->name;
    }
    public function getNamaKabupatenAttribute()
    {
        $item = Kabupaten::where('code', $this->kabupaten)->first();
        return $item->name;
    }
    public function getNamaKecamatanAttribute()
    {
        $item = Kecamatan::where('code', $this->kecamatan)->first();
        return $item->name;
    }
    public function getNamaDesaAttribute()
    {
        $item = Village::where('code', $this->desa)->first();
        return $item->name;
    }
}
