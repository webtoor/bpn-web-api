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
            $results = ReportHarian::where('user_id', $accessToken->user_id)->orderBy('id', 'desc')->get();
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
