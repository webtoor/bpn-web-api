<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KotaKabupaten;
use App\Models\Kecamatan;

class LocationController extends Controller
{
    public function kotakab(){
        try {
            $results = KotaKabupaten::where('province_id', 32)->get();
            return response()->json([
                'status' => '1',
                'data' => $results
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => '0',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function kecamatan($kotakab_id){
        try {
            $results = Kecamatan::where('regency_id', $kotakab_id)->get();
            return response()->json([
                'status' => '1',
                'data' => $results
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => '0',
                'error' => $e->getMessage()
            ]);
        }
    }
}
