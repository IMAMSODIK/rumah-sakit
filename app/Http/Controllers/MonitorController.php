<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
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
            return [
                'id' => $pasien->id,
                'nama' => $pasien->nama,
                'kode' => $pasien->kode,
                'waktu_masuk' => $pasien->waktu_masuk,
                'jenis_layanan' => $jenisLayanan ?  $jenisLayanan->jenis_layanan : "Layanan Tidak Ditemukan",
                'created_at' => $pasien->created_at->format('d M Y H:i'),
            ];
        });

        return response()->json([
            'status' => true,
            'data' => $formattedData
        ]);
    }
}
