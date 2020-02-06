<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use lluminate\Validation\Validator;


class ReportController extends Controller
{
    public function PostReport(Request $request){
          
       $validatedData = $this->validate($request,[
        'tanggal_pelaporan' => 'required',
        'lokasi' => 'required',
        'terukur' => 'required',
        'tergambar' => 'required',
        'kkp' => 'required',
        'pengukuran' => 'required',
        'pbt' => 'required',
        'su' => 'required',
        'pengumuman' => 'required',
        'pengesahan' => 'required',
        'keterangan' => 'nullable',
        ]);
    }
}
