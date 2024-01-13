<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\JenisLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JenisLayananController extends Controller
{
    public function index(){
        $layanans = JenisLayanan::select('id', 'jenis_layanan', 'keterangan')->get();
        return view('jenis_layanan.index', [
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
            'jenis_layanan' => $r->jenis_layanan,
            'keterangan' => $r->keterangan_layanan
        ];

        $rules = [
            'jenis_layanan' => 'required|string|max:255|unique:jenis_layanans',
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => implode(', ', $validator->errors()->all())
            ]);
        }

        try {
            $data = JenisLayanan::create([
                'jenis_layanan' => $r->jenis_layanan,
                'keterangan' => $r->keterangan_layanan
            ]);

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
        $data = JenisLayanan::where('id', $r->id)->first();

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
            'jenis_layanan' => $r->jenis_layanan,
            'keterangan' => $r->keterangan_layanan
        ];

        $rules = [
            'jenis_layanan' => 'required|string|max:255|unique:jenis_layanans,jenis_layanan,'.$r->id,
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => implode(', ', $validator->errors()->all())
            ]);
        }


        try {
            $data = JenisLayanan::where('id', $r->id)->first();

            if($data){
                $data->jenis_layanan = $r->jenis_layanan;
                $data->keterangan = $r->keterangan_layanan;
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
        $data = JenisLayanan::where('id', $r->id)->first();
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
