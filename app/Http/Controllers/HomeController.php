<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KumulatifExport;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\ProjectLocation;
use App\Models\KotaKabupaten;
use App\Models\ReportHarian;
use App\Models\UserRole;

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

    public function ajaxGetPelaksana($kotakab_id){
        $collect =  ProjectLocation::with(['user' => function ($query) {
             $query->where('status', '1'); 
            }])->where('kotakab_id', $kotakab_id)->get();
        $unique = collect($collect)->unique('user_id');
        $lokasi = $unique->values()->all();
       /*  $lokasi =  ProjectLocation::with(['kecamatan','desa','user' => function ($query) {
            $query->where('status', '1'); 
           }])->where('kotakab_id', $kotakab_id)->get(); */
        return response()->json([
            'status' => '1',
            'data' => $lokasi
        ]);
    }
    public function postFilter(Request $request){
        //return $request;
        $pelaksana_id = $request->pelaksana_id;
        $kotakab_id = $request->kotakab_id;
        $dtarray = explode("-",$request->dtrange); 
        return $this->LaporanHarian($kotakab_id, $pelaksana_id, $dtarray);


    }
    public function index()
    {
        $user =  User::with(['project_location' => function ($query) {
            $query->with('kotakab', 'kecamatan', 'desa');
            }])->where('status', '0')->get();
        return view('admin.dashboard', ['user' => $user]);
    }

    public function verifikasi(Request $request){
        User::where('id',$request->pelaksana_id)->update([
            'status' => '1'
        ]);
        return back()->withSuccess(trans('Anda Berhasil melakukan verifikasi')); 
    }

    public function rejectVerifikasi(Request $request){
        User::where('id',$request->pelaksana_ids)->delete();
        DB::statement("ALTER TABLE users AUTO_INCREMENT = 1");
        DB::statement("ALTER TABLE user_role AUTO_INCREMENT = 1");
        DB::statement("ALTER TABLE project_location AUTO_INCREMENT = 1");

        return back()->withSuccess(trans('Anda Berhasil menghapus pelaksana')); 
    }

    public function LaporanHarian($kotakab_id, $pelaksana_id, $dtarray){
        $dtstart = $dtarray[0];
        $dtend = $dtarray[1];
        $datestart = str_replace('/', '-', $dtstart);
        $dateend = str_replace('/', '-', $dtend);
        if(($kotakab_id == 'default') && ($pelaksana_id == 'default') && ($dtarray == 'default')){
            $reportharian = ReportHarian::with(['project_location' => function ($query) {
                $query->with('user', 'kotakab', 'kecamatan', 'desa');
                }])->where('dtreport', '>=', Carbon::today())->get();
                $datestart = null;
                $dateend = null;
            $kotakab = KotaKabupaten::where('province_id', 32)->get();
        }elseif(($kotakab_id != 'default') && ($pelaksana_id != 'default') && ($dtarray != 'default')){
            $detail_array = ProjectLocation::where(['user_id' => $pelaksana_id, 'kotakab_id' => $kotakab_id])->get();
            $array = [];
            foreach($detail_array as $data){
                $array[] = $data->id;
            }
            $reportharian = ReportHarian::with(['project_location' => function ($query) {
                $query->with('user', 'kotakab', 'kecamatan', 'desa');
                }])->whereIn('project_location_id', $array)->whereBetween('dtreport', [date('Y-m-d', strtotime($datestart)), date('Y-m-d', strtotime($dateend))])->get();
            $kotakab = KotaKabupaten::where('province_id', 32)->get();
        }
        return view('admin.laporan-harian', ['reportharian' => $reportharian, 'kotakab' => $kotakab, 'datestart' => $datestart, 'dateend' => $dateend]);

    }

    public function LaporanKumulatif(){
        $kota = KotaKabupaten::with(['project_location' => function ($query) {
            $query->with(['user', 'kotakab', 'kecamatan', 'desa', 'reportharian']);
        }])->where('province_id', 32)->get();
        return view('admin.laporan-kumulatif', ['kota' => $kota]);
    }

    public function LaporanKumulatifDetail($kotakab_id){
        $detail =  ProjectLocation::with(['user','kotakab', 'kecamatan', 'desa','reportharian'])->where('kotakab_id', $kotakab_id)->get();
        return view('admin.laporan-kum-detail', ['detail' => $detail]);
    }

    public function KumulatifExport(){
        $nama_file = 'laporan_kumulatif_'.date('Y-m-d_H-i-s').'.xlsx';
        return Excel::download(new KumulatifExport, $nama_file);
    }
}
