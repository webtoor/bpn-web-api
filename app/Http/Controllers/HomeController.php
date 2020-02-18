<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\ProjectLocation;
use App\Models\KotaKabupaten;
use App\Models\ReportHarian;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   /*  public function __construct()
    {
        $this->middleware('admin');
    } */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    public function LaporanHarian(){
        $reportharian = ReportHarian::with(['project_location' => function ($query) {
            $query->with('user', 'kotakab', 'kecamatan', 'desa');
            }])->where('created_at', '>=', Carbon::today())->get();
        return view('admin.laporan-harian', ['reportharian' => $reportharian]);
    }

    public function LaporanKumulatif(){
        $kota = KotaKabupaten::with(['project_location' => function ($query) {
            $query->with(['user', 'kotakab', 'kecamatan', 'desa', 'reportharian']);
        }])->where('province_id', 32)->get();
        return view('admin.laporan-kumulatif', ['kota' => $kota]);
    }
}
