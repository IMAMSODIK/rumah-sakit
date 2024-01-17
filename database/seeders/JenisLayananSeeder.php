<?php

namespace Database\Seeders;

use App\Models\JenisLayanan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisLayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisLayanan::create([
            'jenis_layanan' => "Penyakit Dalam"
        ]);

        JenisLayanan::create([
            'jenis_layanan' => "Penyakit Luar"
        ]);
    }
}
