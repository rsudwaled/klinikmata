<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kunjungan>
 */
class KunjunganFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [

            'kode' => "MAT" . fake()->numerify('####'),
            'kode_ihs' =>  fake()->numerify('######'),
            'tgl_masuk' =>  now(),
            'pasien_id' =>  fake()->numberBetween(1, 10),
            'dokter_id' =>  fake()->numberBetween(1, 2),
            'penjamin_id' =>  fake()->numberBetween(1, 2),
            'status' => 1,
            'pic' => 1,
            'poliklinik' => 'MAT',
            'tujuan' =>  fake()->randomElement(['POLIKLINIK', 'FARMASI', 'OPTIK']),
            'keluhan' => fake()->randomElement(['Mau periksa mata', 'mata perih', 'ambil kacamata', 'butuh obat mata']),

        ];
    }
}
