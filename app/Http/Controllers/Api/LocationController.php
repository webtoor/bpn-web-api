<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\KotaKabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\ProjectLocation;

class LocationController extends Controller
{
    public function GetKotaKab(){
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

    public function GetKecamatan($kotakab_id){
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

    public function GetDesa($kecamatan_id){
        try {
            $results = Desa::where('district_id', $kecamatan_id)->get();
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

    public function GetLocation(){
        $accessToken = Auth::user()->token();
        try {
            $results = ProjectLocation::with('kotakab', 'kecamatan', 'desa')->where(['user_id' => $accessToken->user_id])->get();
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

    public function AddNewLocation(Request $request){
        $validatedData = $this->validate($request,[
            'kotakab' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'target_pbt' => 'required|numeric',
            'target_shat' => 'required|numeric',
            'target_k4' => 'required|numeric',
            'tim' => 'required|numeric',
        ]);
        $accessToken = Auth::user()->token();

        try {
            ProjectLocation::create([
                'user_id' => $accessToken->user_id,
                'kotakab_id' => $validatedData['kotakab'],
                'kecamatan_id' => $validatedData['kecamatan'],
                'desa_id' => $validatedData['desa'],
                'target_pbt' => $validatedData['target_pbt'],
                'target_shat' => $validatedData['target_shat'],
                'target_k4' => $validatedData['target_k4'],
                'tim' => $validatedData['tim']
            ]);
            return response()->json([
                'status' => '1',
                'message' => 'success'
            ]);
 
         } catch (\Exception $e) {
             return response()->json([
                 'status' => '0',
                 'error' => $e->getMessage()
             ]);
        }

    }
}
