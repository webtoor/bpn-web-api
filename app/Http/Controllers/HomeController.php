<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectLocation;
use App\Models\KotaKabupaten;

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
        $kota = KotaKabupaten::with('project_location')->where('province_id', 32)->get();
        return view('admin.laporan-harian', ['kota' => $kota]);
    }
}
