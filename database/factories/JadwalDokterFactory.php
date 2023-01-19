<?php

namespace Database\Factories;

use App\Models\Dokter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JadwalDokter>
 */
class JadwalDokterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $dokter = Dokter::find(2);

        return [
            //
            'kodepoli' => "MAT",
            'namapoli' =>  "MATA",
            'kodesubspesialis' =>  "MAT",
            'namasubspesialis' =>  "MATA",
            'kodedokter' =>  $dokter->kode,
            'kodedokter_jkn' =>  $dokter->kode_jkn,
            'namadokter' => $dokter->preffix . ' ' . $dokter->nama . ' ' . $dokter->suffix,
            'hari' =>  1,
            'namahari' => "SENIN",
            'jampraktek' => '08:00 - 12:00',
            'kapasitaspasien' =>  20,
            'libur' => 0,
            'pic' => 1,
        ];
    }
}
