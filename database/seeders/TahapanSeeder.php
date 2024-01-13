<?php

namespace Database\Seeders;

use App\Models\Tahapan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TahapanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tahapan::create([
            'jam_pertama' => 0.0,
            'jam_kedua' => 0.0,
            'jam_ketiga' => 0.0,
            'jam_keempat' => 0.0,
        ]);
    }
}
