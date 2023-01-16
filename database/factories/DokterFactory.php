<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dokter>
 */
class DokterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'kode' => "DOK" . fake()->numerify('####'),
            'kode_jkn' =>  fake()->numerify('######'),
            'kode_ihs' =>  fake()->numerify('########'),
            'nik' => fake()->numerify('3209####4523####'),

            'nama' => fake()->name(),
            'suffix' => 'dr.',
            'preffix' => ',Sp.M',
            'sip' => '449/SIP.DSp-344/SDK/DINKES/V/2022',
            'poliklinik' => 'MAT',
            'subspesialis' => 'MAT',

            'nohp' => fake()->numerify('0895########'),
            'pic' => 1,
        ];
    }
}
