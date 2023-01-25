<?php

namespace Database\Seeders;

use App\Models\BPJS\Antrian\PoliklinikAntrian;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = User::create([
            "name" => "Admin IT",
            "email" => "adminit@gmail.com",
            "username" => "adminit",
            "phone" => "089529909036",
            'password' => bcrypt('qweqwe123'),
            'user_id' => 2,
            'email_verified_at' => now()

        ]);
        $user->assignRole('Admin');
        $user = User::create([
            "name" => "Admin Super",
            "email" => "adminrs@gmail.com",
            "username" => "adminrs",
            "phone" => "089529909036",
            'password' => bcrypt('qweqwe123'),
            'user_id' => 2,
            'email_verified_at' => now()
        ]);
        $user->assignRole('Admin Super');
        $user = User::create([
            "name" => "Marwan Dhiaur Rahman",
            "email" => "marwandhiaurrahman@gmail.com",
            "username" => "marwan",
            "phone" => "089529909036",
            'password' => bcrypt('qweqwe123'),
        ]);
        $user->assignRole('Admin Super');
        $user = User::create([
            "name" => "Admin Antrian BPJS",
            "email" => "antrianbpjs@gmail.com",
            "username" => "antrianbpjs",
            "phone" => "089529909036",
            'password' => bcrypt('antrianbpjs'),
            'user_id' => 2,
            'email_verified_at' => now()
        ]);
        $user->assignRole('Admin Super');

        $user = User::create([
            "name" => "Admin Pendaftaran",
            "email" => "pendaftaran@gmail.com",
            "username" => "pendaftaran",
            "phone" => "089529909036",
            'password' => bcrypt('pendaftaran'),
        ]);
        $user->assignRole('Pendaftaran');
        $user = User::create([
            "name" => "Admin Kasir",
            "email" => "kasir@gmail.com",
            "username" => "kasir",
            "phone" => "089529909036",
            'password' => bcrypt('kasir'),
        ]);
        $user->assignRole('Kasir');
        $user = User::create([
            "name" => "Admin Farmasi",
            "email" => "farmasi@gmail.com",
            "username" => "farmasi",
            "phone" => "089529909036",
            'password' => bcrypt('farmasi'),
        ]);
        $user->assignRole('Farmasi');
        $user = User::create([
            "name" => "Admin Perawat",
            "email" => "perawat@gmail.com",
            "username" => "perawat",
            "phone" => "089529909036",
            'password' => bcrypt('perawat'),
        ]);
        $user->assignRole('Perawat');
        $user = User::create([
            "name" => "Admin Dokter",
            "email" => "dokter@gmail.com",
            "username" => "dokter",
            "phone" => "089529909036",
            'password' => bcrypt('dokter'),
        ]);
        $user->assignRole('Dokter');

    }
}
