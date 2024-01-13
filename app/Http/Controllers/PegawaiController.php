<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    public function index(){
        $listPegawai = User::select('id', 'name', 'foto', 'nip', 'username', 'created_at')->get();
        return view('pegawai.index', [
            'pegawais' => $listPegawai
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
            'name' => $r->nama_pegawai,
            'nip' => $r->nip
        ];

        $rules = [
            'name' => 'required|string|max:255',
            'nip' => 'required|string|size:16|unique:users'
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => implode(', ', $validator->errors()->all())
            ]);
        }


        try {
            $data = User::create([
                'name' => $r->nama_pegawai,
                'nip' => $r->nip,
                'username' => $r->nip,
                'password' => bcrypt($r->nip)
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
        $data = User::where('id', $r->id)->first();

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
            'name' => $r->nama_pegawai,
            'nip' => $r->nip
        ];

        $rules = [
            'name' => 'required|string|max:255',
            'nip' => 'required|string|size:16|unique:users,nip,'.$r->id
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => implode(', ', $validator->errors()->all())
            ]);
        }


        try {
            $data = User::where('id', $r->id)->first();

            if($data){
                $data->name = $r->nama_pegawai;
                $data->nip = $r->nip;
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
        $data = User::where('id', $r->id)->first();
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
