<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Pasien;
use App\Models\JenisLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PasienController extends Controller
{
    public function index(){
        $pasiens = Pasien::with('layanan')->get();

        return view('pasien.index', [
            'pasiens' => $pasiens
        ]);
    }

    public function store(Request $r){
        $messages = [
            'required' => 'Kolom :attribute harus diisikan',
            'unique' => ':attribute sudah terdaftar',
            'string' => ':attribute harus berupa teks',
            'size' => ':attribute harus berukuran :size karakter',
            'between' => ':attribute harus di antara :min dan :max karakter',
            'not_in' => ':attribute Harus Dipilih',
        ];

        $data = [
            "nama" => $r->nama,
            "usia" => $r->usia,
            "no_rekam_medis" => $r->no_rekam_medis,
        ];

        $rules = [
            'nama' => 'required|string|max:255',
            'usia' => 'required|string|max:255',
            'no_rekam_medis' => 'required|string|max:255',
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => implode(', ', $validator->errors()->all())
            ]);
        }

        try {
            $data = Pasien::create($data);

            if($data){
                return response()->json([
                    'status' => true,
                    'data' => $data
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Gagal Menambahkan Data',
            ]);
        } catch(Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'an error occured : ' . $e->getMessage(),
            ]);
        }
    }

    public function edit(Request $r){
        $data = Pasien::where('id', $r->id)->first();

        if($data){
            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => "Gagal memuat data"
        ]);
    }

    public function editLayanan(Request $r){
        $data = Pasien::with('layanan')->where('id', $r->id)->first();

        if($data){
            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => "Gagal memuat data"
        ]);
    }

    public function update(Request $r){
        $messages = [
            'required' => 'Kolom :attribute harus diisikan',
            'unique' => ':attribute sudah terdaftar',
            'string' => ':attribute harus berupa teks',
            'size' => ':attribute harus berukuran :size karakter',
            'between' => ':attribute harus di antara :min dan :max karakter',
            'not_in' => ':attribute Harus Dipilih',
        ];

        $data = [
            "nama" => $r->nama,
            "usia" => $r->usia,
            "no_rekam_medis" => $r->no_rekam_medis,
        ];

        $rules = [
            'nama' => 'required|string|max:255',
            'usia' => 'required|string|max:255',
            'no_rekam_medis' => 'required|string|max:255',
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => implode(', ', $validator->errors()->all())
            ]);
        }

        try {
            $data = Pasien::where('id', $r->id)->first();

            if($data){
                $data->nama = $r->nama;
                $data->usia = $r->usia;
                $data->no_rekam_medis = $r->no_rekam_medis;
                $data->save();

                return response()->json([
                    'status' => true
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Gagal Mengupdate Data',
            ]);
        } catch(Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'an error occured : ' . $e->getMessage(),
            ]);
        }
    }

    public function delete(Request $r){
        $data = Pasien::where('id', $r->id)->first();
        if($data){
            try {
                $data->delete();

                return response()->json([
                    'status' => true
                ]);
            } catch(Exception $e){
                return response()->json([
                    'status' => false,
                    'message' => 'an error occured : ' . $e->getMessage(),
                ]);
            }
        }

        return response()->json([
            'status' => false,
            'message' => 'Gagal Memuat Data',
        ]);
    }
}
