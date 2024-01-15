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
            'kode' => '0001',
            'nama' => 'Imam Sodik',
            'waktu_masuk' => '19:20',
            'jenis_layanan_id' => 1
        ]);

        Pasien::create([
            'kode' => '0002',
            'nama' => 'Imam Sodik 2',
            'waktu_masuk' => '19:10',
            'jenis_layanan_id' => 1
        ]);
        Pasien::create([
            'kode' => '0001',
            'nama' => 'Imam Sodik',
            'waktu_masuk' => '15:20',
            'jenis_layanan_id' => 1
        ]);
        Pasien::create([
            'kode' => '0001',
            'nama' => 'Imam Sodik',
            'waktu_masuk' => '12:20',
            'jenis_layanan_id' => 1
        ]);
        Pasien::create([
            'kode' => '0001',
            'nama' => 'Imam Sodik',
            'waktu_masuk' => '10:20',
            'jenis_layanan_id' => 1
        ]);
        Pasien::create([
            'kode' => '0001',
            'nama' => 'Imam Sodik',
            'waktu_masuk' => '07:20',
            'jenis_layanan_id' => 2
        ]);
        Pasien::create([
            'kode' => '0001',
            'nama' => 'Imam Sodik',
            'waktu_masuk' => '02:20',
            'jenis_layanan_id' => 2
        ]);
        Pasien::create([
            'kode' => '0001',
            'nama' => 'Imam Sodik',
            'waktu_masuk' => '05:20',
            'jenis_layanan_id' => 2
        ]);
        Pasien::create([
            'kode' => '0001',
            'nama' => 'Imam Sodik',
            'waktu_masuk' => '00:00',
            'jenis_layanan_id' => 2
        ]);
        Pasien::create([
            'kode' => '0001',
            'nama' => 'Imam Sodik',
            'waktu_masuk' => '23:20',
            'jenis_layanan_id' => 2
        ]);
        Pasien::create([
            'kode' => '0001',
            'nama' => 'Imam Sodik',
            'waktu_masuk' => '15:20',
            'jenis_layanan_id' => 2
        ]);
    }
}
