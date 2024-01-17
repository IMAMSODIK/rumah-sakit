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

    public function parseJam($jam){
        $explode = explode(":", $jam);
        return $explode[0]." Jam ".$explode[1]." Menit ";
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
            'jam_pertama' => 'required|string',
            'jam_kedua' => 'required|string',
            'jam_ketiga' => 'required|string',
            'jam_keempat' => 'required|string',
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => implode(', ', $validator->errors()->all())
            ]);
        }


        try {
            $model = Tahapan::first();

            if($model){
                $model->update($data);

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
