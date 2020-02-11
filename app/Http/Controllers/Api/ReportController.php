<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use lluminate\Validation\Validator;
use App\Models\ReportHarian;


class ReportController extends Controller
{
    public function PostReport(Request $request)
    {
        $validatedData = $this->validate($request, [
        'lokasi' => 'required',
        'terukur' => 'required',
        'tergambar' => 'required',
        'kkp' => 'required',
        'pengukuran' => 'required',
        'pemetaan' => 'required',
        'pbt' => 'required',
        'su' => 'required',
        'pengumuman' => 'required',
        'pengesahan' => 'required',
        'keterangan' => 'nullable',
        'dtreport' => 'required'
        ]);

        $accessToken = Auth::user()->token();

        try {
            $check = ReportHarian::where(['user_id' => $accessToken->user_id, 'dtreport' => $validatedData['dtreport']])->get();
            if(count($check) < 1){
                $results = ReportHarian::create([
                    'user_id' => $accessToken->user_id,
                    'project_location_id' => $validatedData['lokasi'],
                    'terukur' => $validatedData['terukur'],
                    'tergambar' => $validatedData['tergambar'],
                    'kkp' => $validatedData['kkp'],
                    'pengukuran' => $validatedData['pengukuran'],
                    'pemetaan' => $validatedData['pemetaan'],
                    'pbt' => $validatedData['pbt'],
                    'su' => $validatedData['su'],
                    'pengumuman' => $validatedData['pengumuman'],
                    'pengesahan' => $validatedData['pengesahan'],
                    'keterangan' => $validatedData['keterangan'],
                    'dtreport' => $validatedData['dtreport']
                ]);
                return response()->json([
                    'status' => '1',
                    'message' => 'success'
                ]);
            }else{
                return response()->json([
                    "status" => "0",
                    "message" => "Anda telah membuat Laporan pada tanggal yang sama"
                ]);
            }
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => '0',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function GetReport()
    {
        $accessToken = Auth::user()->token();

        try {
            $results = ReportHarian::with(['project_location' => function ($query) {
                $query->with('kotakab', 'kecamatan', 'desa');
            }])->where('user_id', $accessToken->user_id)->orderBy('id', 'desc')->get();
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

    public function GetSingleReport($id)
    {
        $accessToken = Auth::user()->token();

        try {
            $results = ReportHarian::with(['project_location' => function ($query) {
                $query->with('kotakab', 'kecamatan', 'desa');
            }])->where(['user_id' => $accessToken->user_id, 'id' => $id])->orderBy('id', 'desc')->first();
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

    public function PostSingleReport(Request $request, $id)
    {
        $validatedData = $this->validate($request, [
        'terukur' => 'required',
        'tergambar' => 'required',
        'kkp' => 'required',
        'pengukuran' => 'required',
        'pemetaan' => 'required',
        'pbt' => 'required',
        'su' => 'required',
        'pengumuman' => 'required',
        'pengesahan' => 'required',
        'keterangan' => 'nullable',
        ]);

        $accessToken = Auth::user()->token();

        try {
            $results = ReportHarian::find($id)->update([
                'terukur' => $validatedData['terukur'],
                'tergambar' => $validatedData['tergambar'],
                'kkp' => $validatedData['kkp'],
                'pengukuran' => $validatedData['pengukuran'],
                'pemetaan' => $validatedData['pemetaan'],
                'pbt' => $validatedData['pbt'],
                'su' => $validatedData['su'],
                'pengumuman' => $validatedData['pengumuman'],
                'pengesahan' => $validatedData['pengesahan'],
                'keterangan' => $validatedData['keterangan']
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
