<?php

namespace Database\Seeders;

use App\Models\Pasien;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pasien::create([
            'nama' => 'Alex Nander',
            'usia' => 45,
            'no_rekam_medis' => '0001'
        ]);

        Pasien::create([
            'nama' => 'Adriano Pakpahan',
            'usia' => 54,
            'no_rekam_medis' => '0002'
        ]);
        Pasien::create([
            'nama' => 'Firman Utina',
            'usia' => 62,
            'no_rekam_medis' => '0003'
        ]);
        Pasien::create([
            'nama' => 'Zulham Zamrun',
            'usia' => 45,
            'no_rekam_medis' => '0004'
        ]);

        Pasien::create([
            'nama' => 'Imam Sodik',
            'usia' => 23,
            'no_rekam_medis' => '0005'
        ]);
    }
}
