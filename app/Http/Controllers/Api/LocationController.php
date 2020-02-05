<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KotaKabupaten;
use App\Models\Kecamatan;

class LocationController extends Controller
{
    public function kotakab(){
        return KotaKabupaten::where('province_id', 32)->get();
    }

    public function kecamatan($kotakab_id){
        return Kecamatan::where('regency_id', 3272)->get();
    }
}
