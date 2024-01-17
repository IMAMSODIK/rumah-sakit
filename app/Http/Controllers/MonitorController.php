<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Tahapan;
use Illuminate\Http\Request;

class MonitorController extends Controller
{
    public function index(){
        return view('pasien.dashboard');
    }

    public function loadData(){
        $data = Pasien::all();

        $formattedData = $data->map(function ($pasien) {
            $jenisLayanan = $pasien->jenisLayanan;
            $tahapan = null;
            switch($pasien->tahap){
                case 1:
                    $tahapan = Tahapan::first()->jam_pertama;
                    break;
                case 2:
                    $tahapan = Tahapan::first()->jam_kedua;
                    break;
                case 3:
                    $tahapan = Tahapan::first()->jam_ketiga;
                    break;
                case 4:
                    $tahapan = Tahapan::first()->jam_keempat;
                    break;
            }
            return [
                'id' => $pasien->id,
                'nama' => $pasien->nama,
                'kode' => $pasien->kode,
                'waktu_masuk' => $pasien->waktu_masuk,
                'jenis_layanan' => $jenisLayanan ?  $jenisLayanan->jenis_layanan : "Layanan Tidak Ditemukan",
                'tahap' => $tahapan,
                'created_at' => $pasien->created_at->format('d M Y H:i'),
            ];
        });

        return response()->json([
            'status' => true,
            'data' => $formattedData
        ]);
    }
}
