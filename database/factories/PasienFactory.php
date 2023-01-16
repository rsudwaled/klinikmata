<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pasien>
 */
class PasienFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $sex = fake()->randomElements(['male', 'female']);
        if ($sex == 'male') {
            $kodesex = 'L';
        } else {
            $kodesex = 'P';
        }
        $kode = fake()->numberBetween(10, 17);
        return [
            'nik' => fake()->numerify('3209####0011####'),
            'no_rm' => fake()->numerify('A######'),
            'no_bpjs' => fake()->numerify('0067####0062#'),
            'nama' => fake()->name($sex),
            'sex' => $kodesex,
            'nohp' => fake()->numerify('0895########'),
            'tgl_lahir' => fake()->date('Y-m-d'),
            'alamat' => fake()->streetAddress(),
            'pic' => 1,
            'provinsi' => 32,
            'kabupaten' => 3209,
            'kecamatan' => 320902,
            'desa' => "32090220" . $kode,
        ];
    }
}
