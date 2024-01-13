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
        $pasiens = Pasien::all();
        $layanans = JenisLayanan::select('id', 'jenis_layanan')->get();

        return view('pasien.index', [
            'pasiens' => $pasiens,
            'layanans' => $layanans
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
            "kode" => $r->kode,
            "waktu_masuk" => $r->waktu_masuk,
            "jenis_layanan_id" => $r->jenis_layanan,
        ];

        $rules = [
            'nama' => 'required|string|max:255',
            'kode' => 'required|string|max:255|unique:pasiens',
            'waktu_masuk' => 'required',
            'jenis_layanan_id' => 'required'
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
            "kode" => $r->kode,
            "waktu_masuk" => $r->waktu_masuk,
            "jenis_layanan_id" => $r->jenis_layanan,
        ];

        $rules = [
            'nama' => 'required|string|max:255',
            'kode' => 'required|string|max:255|unique:pasiens',
            'waktu_masuk' => 'required',
            'jenis_layanan_id' => 'required'
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
                $data->kode = $r->kode;
                $data->nama = $r->nama;
                $data->waktu_masuk = $r->waktu_masuk;
                $data->jenis_layanan_id = $r->jenis_layanan;
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
