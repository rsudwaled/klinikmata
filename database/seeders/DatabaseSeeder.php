<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Dokter;
use App\Models\JadwalDokter;
use App\Models\Kunjungan;
use App\Models\Pasien;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PoliklinikSeeder::class);
        $this->call(RuanganSeeder::class);

        Pasien::factory(50)->create();
        Dokter::factory(50)->create();
        Kunjungan::factory(50)->create();
        JadwalDokter::factory(1)->create();

        $this->command->info('Loading Tarif table seed');
        $path = 'public/sql/tarif.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Tarif table seeded');

        $this->command->info('Loading Obat table seed');
        $path = 'public/sql/obat.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Obat table seeded');

        $this->command->info('Loading ICD 9 table seed');
        $path = 'public/sql/icd9.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('ICD 9 table seeded');

        $this->command->info('Loading ICD 10 table seed');
        $path = 'public/sql/icd10.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('ICD 10 table seeded');

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
