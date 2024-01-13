<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Tahapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TahapanController extends Controller
{
    public function index(){
        $tahapan = Tahapan::first();
        return view('tahapan.index', [
            'tahapan' => $tahapan
        ]);
    }

    public function edit(){
        $data = Tahapan::first();

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
            'numeric' => ':attribute Harus Berupa Angka'
        ];

        $data = [
            'jam_pertama' => $r->jam_pertama,
            'jam_kedua' => $r->jam_kedua,
            'jam_ketiga' => $r->jam_ketiga,
            'jam_keempat' => $r->jam_keempat,
        ];

        $rules = [
            'jam_pertama' => 'required|numeric',
            'jam_kedua' => 'required|numeric',
            'jam_ketiga' => 'required|numeric',
            'jam_keempat' => 'required|numeric',
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => implode(', ', $validator->errors()->all())
            ]);
        }


        try {
            $data = Tahapan::first();

            if($data){
                $data->jam_pertama = $r->jam_pertama;
                $data->jam_kedua = $r->jam_kedua;
                $data->jam_ketiga = $r->jam_ketiga;
                $data->jam_keempat = $r->jam_keempat;
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
}
