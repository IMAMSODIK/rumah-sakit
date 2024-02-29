<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LayananController extends Controller
{
    public function updateLayanan(Request $r){
        $now = Carbon::now('Asia/Jakarta')->format('H:i');
        $messages = [
            'numeric' => 'Nilai :attribute tidak valid!',
        ];

        $data = [
            'pasien_id' => $r->id,
            'triase' => $r->status_triase,
            'spri' => $r->status_spri,
            'admisi' => $r->status_admisi,
            'pemeriksaan_penunjang' => $r->status_penunjang,
            'dpjp' => $r->status_dpjp,
            'transfer_pasien' => $r->status_transfer,
            'ketersediaan_ruang' => $r->status_ketersediaan_ruang,
            'masuk_ruang' => $r->status_masuk_ruangan,
        ];

        $rules = [
            'triase' => 'numeric|min:0|max:1',
            'spri' => 'numeric|min:0|max:1',
            'admisi' => 'numeric|min:0|max:1',
            'pemeriksaan_penunjang' => 'numeric|min:0|max:1',
            'dpjp' => 'numeric|min:0|max:1',
            'transfer_pasien' => 'numeric|min:0|max:1',
            'ketersediaan_ruang' => 'numeric|min:0|max:1',
            'masuk_ruang' => 'numeric|min:0|max:1',
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => implode(', ', $validator->errors()->all())
            ]);
        }

        try {
            $layananCtr = Layanan::where('pasien_id', $r->id)->first();
            if($layananCtr){
                if($r->status_triase != $layananCtr->triase){
                    $layananCtr->triase = $r->status_triase;
                    $layananCtr->time_triase = $now;
                }

                if($r->status_spri != $layananCtr->spri){
                    $layananCtr->spri = $r->status_spri;
                    $layananCtr->time_spri = $now;
                }

                if($r->status_admisi != $layananCtr->admisi){
                    $layananCtr->admisi = $r->status_admisi;
                    $layananCtr->time_admisi = $now;
                }

                if($r->status_penunjang != $layananCtr->pemeriksaan_penunjang){
                    $layananCtr->pemeriksaan_penunjang = $r->status_penunjang;
                    $layananCtr->time_pemeriksaan_penunjang = $now;
                }

                if($r->status_dpjp != $layananCtr->dpjp){
                    $layananCtr->dpjp = $r->status_dpjp;
                    $layananCtr->time_dpjp = $now;
                }

                if($r->status_transfer != $layananCtr->transfer_pasien){
                    $layananCtr->transfer_pasien = $r->status_transfer;
                    $layananCtr->time_transfer_pasien = $now;
                }

                if($r->status_ketersediaan_ruang != $layananCtr->ketersediaan_ruang){
                    $layananCtr->ketersediaan_ruang = $r->status_ketersediaan_ruang;
                    $layananCtr->time_ketersediaan_ruang = $now;
                }

                if($r->status_masuk_ruang != $layananCtr->masuk_ruang){
                    $layananCtr->masuk_ruang = $r->status_masuk_ruang;
                    $layananCtr->time_masuk_ruang = $now;
                }

                $layananCtr->save();
                return response()->json([
                    'status' => true
                ]);
            }else{
                $create = Layanan::create([
                    'pasien_id' => $r->id,
                    'triase' => $r->status_triase,
                    'spri' => $r->status_spri,
                    'admisi' => $r->status_admisi,
                    'pemeriksaan_penunjang' => $r->status_penunjang,
                    'dpjp' => $r->status_dpjp,
                    'transfer_pasien' => $r->status_transfer,
                    'ketersediaan_ruang' => $r->status_ketersediaan_ruang,
                    'masuk_ruang' => $r->status_masuk_ruangan,
                    'time_triase' => $now,
                    'time_spri' => $now,
                    'time_admisi' => $now,
                    'time_pemeriksaan_penunjang' => $now,
                    'time_dpjp' => $now,
                    'time_transfer_pasien' => $now,
                    'time_ketersediaan_ruang' => $now,
                    'time_masuk_ruang' => $now
                ]);
                if($create){
                    return response()->json([
                        'status' => true
                    ]);
                }else{
                    return response()->json([
                        'status' => false,
                        'message' => "Gagal memperbaharui layanan"
                    ]);
                }
            }
        } catch(Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'an error occured : ' . $e->getMessage(),
            ]);
        }
    }
}
